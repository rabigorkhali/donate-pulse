<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Public\FrontendBaseController;
use App\Models\Campaign;
use App\Models\CampaignView;
use App\Models\Donation;
use App\Models\Partner;
use App\Models\Slider;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Throwable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class HomeController extends FrontendBaseController
{


    public function __construct()
    {
        $this->campaigns = new Campaign();
        $this->sliderBanner = new Slider();
        $this->donation = new Donation();
        $this->dir = "/uploads/donations";
    }

    public function viewFolder()
    {
        return $this->parentViewFolder() . '.index';;
    }
    public function getPage($slug)
    {
        try {
            $data = [];
            $data['pageDetails'] = Page::where('slug', $slug)->first();
            if (!$data['pageDetails']) {
                return redirect('/');
            }
            return $this->renderView($this->parentViewFolder() . '.page', $data);
        } catch (Throwable $th) {
            return $this->renderView($this->parentViewFolder() . '.errorpage', []);
            return redirect('/');
        }
    }

    public function index(Request $request)
    {
        try {
            $data = array();
            $data['featuredCauses'] = CampaignView::where('status', true)
                ->where('is_featured', false)
                ->wherein('campaign_status', ['running'])
                ->orderby('summary_total_collection', 'desc')
                ->take(6)->get();

            $data['recentCauses'] = CampaignView::where('status', true)
                ->where('is_featured', false)
                ->wherein('campaign_status', ['running'])
                ->orderby('summary_total_collection', 'desc')
                ->take(6)->get();

            $data['sliderBanners'] = $this->sliderBanner
                ->where('status', true)
                ->orderby('position', 'asc')
                ->take(3)->get();
            $data['total_campaign'] = $this->campaigns->where('status', true)->wherenotin('campaign_status', ['pending', 'rejected', 'cancelled'])->count();
            $data['total_collection'] = CampaignView::where('status', true)->wherenotin('campaign_status', ['pending', 'rejected', 'cancelled'])->sum('summary_total_collection');
            $totalDonars = $this->donation->wherein('payment_status', ['completed'])->distinct('giver_user_id')->count();
            $data['total_donars'] = $totalDonars + $this->donation->wherein('payment_status', ['completed'])->where('is_verified', 1)->where('giver_user_id', null)->count();
            $data['total_public_users'] = User::where('status', 'active')->count();
            $donationRaw = $this->donation->with('giver')->wherein('payment_status', ['completed'])->where('is_verified', 1)->orderby('amount')->get();
            $topDonorsList = [];
            foreach ($donationRaw as $donationRawKey => $donationRawDatum) {
                $topDonors = [];
                $topDonors['name'] = $donationRawDatum?->giver?->name ?? $donationRawDatum->fullname;

                if ($donationRawDatum?->giver?->profile_picture) {
                    $topDonors['profile_pic'] = asset('uploads') . '/' . imageName($donationRawDatum?->giver?->profile_picture, '-medium');
                } else {
                    $topDonors['profile_pic'] = asset('static-images/images/usernotfound.png');
                }

                // $topDonors['profile_pic'] = asset('uploads') . '/' . imageName($donationRawDatum?->giver?->profile_picture, '-medium');
                $topDonors['amount'] = $donationRawDatum->amount;
                $topDonors['is_anonymous'] = $donationRawDatum->is_anonymous;
                $topDonors['giver_public_user_id'] = $donationRawDatum->giver_public_user_id;
                array_push($topDonorsList, $topDonors);
            }
            $data['topDonors'] = $topDonorsList;
            $data['testimonials'] = Testimonial::where('status', 1)->get();
            $data['partners'] = Partner::get();
            return $this->renderView($this->viewFolder(), $data);
        } catch (Throwable $th) {
            dd($th);
            return $this->renderView($this->parentViewFolder() . '.errorpage', []);
        }
    }

    public function campaignList(Request $request)
    {
        try {
            $data = array();
            $keyword = trim($request->get('title'));
            $category = trim($request->get('category'));
            if ($category) {
                $categoryDetails = CampaignCategory::where('slug', $category)->where('status', 1)->first();
            }
            $campaignQuery = CampaignView::where('status', true);
            if ($keyword) {
                $campaignQuery = $campaignQuery->where('title', 'LIKE', '%' . $keyword . '%');
            }
            if ($category) {
                $campaignQuery = $campaignQuery->where('campaign_category_id', $categoryDetails?->id);
            }
            $campaignQuery = $campaignQuery->wherenotin('campaign_status', ['pending']);
            $campaignQuery = $campaignQuery->orderby('id', 'desc')
                ->orderby('summary_total_collection', 'desc')
                ->where('campaign_status', '!=', 'pending')->where('status', 1)
                ->paginate(15);

            $data['causesList'] = $campaignQuery;
            $data['campaignCategories'] = CampaignCategory::where('status', 1)->orderby('title', 'asc')->get();
            return $this->renderView($this->parentViewFolder() . '.campaign-list', $data);
        } catch (Throwable $th) {

            return $this->renderView($this->parentViewFolder() . '.errorpage', []);
        }
    }

    public function postList(Request $request)
    {
        try {
            $data = array();
            $keyword = trim($request->get('title'));
            $category = trim($request->get('category'));
            if ($category) {
                $categoryDetails = Category::where('slug', $category)->first();
            }
            $postQuery = Post::where('status', true);
            if ($keyword) {
                $postQuery = $postQuery->where('title', 'LIKE', '%' . $keyword . '%');
            }
            if ($category) {
                $postQuery = $postQuery->where('category_id', $categoryDetails?->id);
            }
            $postQuery = $postQuery->orderby('id', 'desc')
                ->where('status', 1)
                ->paginate(3);

            $data['postList'] = $postQuery;
            $data['postCategories'] = Category::orderby('name', 'asc')->get();
            return $this->renderView($this->parentViewFolder() . '.blog-list', $data);
        } catch (Throwable $th) {

            dd($th);
            return $this->renderView($this->parentViewFolder() . '.errorpage', []);
        }
    }

    public function postDetailPage(Request $request, $slug)
    {
        try {
            $data = array();
            $postDetails = Post::where('status', 'published')
                ->where('slug', $slug)->first();
            $data['postDetails'] = $postDetails;
            $data['postCategories'] = Category::orderby('name', 'asc')->get();
            $data['latestPosts'] = Post::orderby('id', 'desc')->where('status', 'PUBLISHED')->get();
            return $this->renderView($this->parentViewFolder() . '.blog-detail', $data);
        } catch (Throwable $th) {
            dd($th);
            // Session::flash('error', 'Sorry. Something went wrong. Please try again later or contact our support team.');
            return $this->renderView($this->parentViewFolder() . '.errorpage', []);
        }
    }

    public function contactUsView(Request $request)
    {
        $data = [];
        return $this->renderView($this->parentViewFolder() . '.contact-us', $data);
    }

    public function contactUsCreate(Request $request)
    {
        try {
            $data = $request->except('_token');
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:15',
                'email' => 'required|email|max:255',
                'description' => 'required|string|max:255',
                'honeypot' => 'nullable|max:0', // Honeypot field should be empty
            ]);

            if ($validator->fails()) {
                // Handle validation failure (e.g., return error response)
            }
            $data['created_at'] = date('Y-m-d H:i:s');
            $resp = ContactUs::insert($data);
            if ($resp) return true;
            return false;
            return $this->renderView($this->parentViewFolder() . '.contact-us', $data);
        } catch (Throwable $th) {
            return $this->renderView($this->parentViewFolder() . '.errorpage', []);
            return false;
        }
    }

    public function getDonation(Request $request)
    {
        $data = $request->except('_token');
        $insertData = $request->except('_token', 'campaign_slug', 'payment_mode', 'payment_gateway');
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'amount' => 'required|numeric|min:10|max:100000',
            'description' => 'required|string|max:500|min:10',
            'payment_receipt' => 'required_if:payment_gateway,bank|mimes:jpeg,png,pdf|max:2048',
            'payment_gateway' => 'required',
            'mobile_number' => 'required_if:payment_gateway,bank|string|max:15',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {

            $campaignDetails = CampaignView::where('id', $data['campaign_id'])->where('status', 1)->first();
            if (!$campaignDetails) {
                Session::flash('error', 'Error! Campaign not found.');
                return redirect()->back();
            }

            if ($campaignDetails->campaign_status !== 'running') {
                Session::flash('error', 'Error! Only active campaigns can receive donation.');
                return redirect()->back();
            }

            if ($campaignDetails->end_date < date('Y-m-d')) {
                Session::flash('error', 'Sorry. This campaign has expired.');
                return redirect()->back();
            }

            if ($data['payment_gateway'] == 'bank') {
                $paymentGateWayDetails = PaymentGateway::where('slug', 'bank')->first();
            } else {
                $paymentGateWayDetails = PaymentGateway::where('slug', $data['payment_gateway'])->first();
            }
            $insertData['payment_gateway_id'] = $paymentGateWayDetails->id;
            $insertData['campaign_id'] = $campaignDetails->id;
            $insertData['receiver_public_user_id'] = $campaignDetails->public_user_id;
            $insertData['giver_public_user_id'] = Auth::guard('frontend_users')->user()?->id ?? null;
            $insertData['created_at'] = date('Y-m-d H:i:s');
            $insertData['transaction_id'] = 'testest';
            $insertData['service_charge_percentage'] = 7;
            $insertData['payment_status'] = 'pending';
            $insertData['is_anonymous'] = 0;
            $insertData['is_verified'] = 0; //by system admin manually
            if ($request->file('payment_receipt')) {
                $insertData['payment_receipt'] = 'donations/' . $this->uploadImage($this->dir, 'payment_receipt', true, 1280, null);
            }
            $resp = Donation::insert($insertData);
            Session::flash('success', 'Congratulations. Your donation has been successfully received. Please wait for the verification.');
            return redirect()->back();
        } catch (Throwable $th) {
            return $this->renderView($this->parentViewFolder() . '.errorpage', []);
            Session::flash('error', 'Sorry. Something went wrong. Please try again later or contact our support team.');
            return redirect()->back();
        }
    }

    public function campaignDetailPage(Request $request, $slug)
    {
        try {
            $data = array();
            $campaignDetails = CampaignView::where('status', true)
                ->where('campaign_status', '!=', 'pending')
                ->where('slug', $slug)->first();
            $data['campaignDetails'] = $campaignDetails;
            $data['countries'] = Country::orderby('name', 'asc')->get();
            $data['paymentGateways'] = PaymentGateway::orderby('position', 'asc')->where('status', 1)->where('show_in_frontend', 1)->get();
            $topDonorsList = [];
            $donationRaw = $this->donation->with('giver')->where('campaign_id', $campaignDetails->id)->wherein('payment_status', ['completed'])->where('is_verified', 1)->orderby('amount')->get();
            foreach ($donationRaw as $donationRawKey => $donationRawDatum) {
                $topDonors = [];
                $topDonors['name'] = $donationRawDatum?->giver?->name ?? $donationRawDatum->fullname;
                if ($donationRawDatum?->giver?->profile_picture) {
                    $topDonors['profile_pic'] = asset('uploads') . '/' . imageName($donationRawDatum?->giver?->profile_picture, '-medium');
                } else {
                    $topDonors['profile_pic'] = asset('static-images/images/usernotfound.png');
                }
                $topDonors['amount'] = $donationRawDatum->amount;
                $topDonors['is_anonymous'] = $donationRawDatum->is_anonymous;
                $topDonors['giver_public_user_id'] = $donationRawDatum->giver_public_user_id;
                array_push($topDonorsList, $topDonors);
            }
            $data['topDonors'] = $topDonorsList;
            return $this->renderView($this->parentViewFolder() . '.campaign-detail', $data);
        } catch (Throwable $th) {
            // Session::flash('error', 'Sorry. Something went wrong. Please try again later or contact our support team.');
            return $this->renderView($this->parentViewFolder() . '.errorpage', []);
        }
    }

    public function khaltiPaymentVerification(Request $request)
    {
        //hit the khalit server

        try {
            $args = http_build_query(array(
                'token' => $request->input('trans_token'),
                'amount' => $request->input('amount')
            ));
            $url = 'https://khalti.com/api/v2/payment/verify/';
            # Make the call using API.
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $headers = ['Authorization: Key ' . env('KHALTI_SECRET_KEY')];
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            // Response
            $response = curl_exec($ch);
            $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $response = json_decode($response);
            curl_close($ch);

            /* LOG */
            $form_data = $request->input('form_data');
            $formDataArray = [];
            foreach ($form_data as $item) {
                $formDataArray[$item['name']] = $item['value'];
            }
            $paymentGateWayDetails = PaymentGateway::where('slug', 'khalti')->where('status', 1)->first();
            $campaignDetails = CampaignView::where('status', 1)->first();

            if (!$campaignDetails) {
                Session::flash('error', 'Campaign not found.');
                return redirect()->back();
            }

            if (!$paymentGateWayDetails) {
                Session::flash('error', 'Invalid payment gateway.');
                return redirect()->back();
            }
            if ($status_code == 200) {
                /* donateaoro */
                $insertData = [];
                $insertData['amount'] = $response->amount / 100;
                $insertData['fullname'] = trim($formDataArray['fullname']);
                $insertData['country'] = trim($formDataArray['country']);
                $insertData['email'] = trim($formDataArray['email']);
                $insertData['address'] = trim($formDataArray['address']);
                $insertData['description'] = trim($formDataArray['description']);
                $insertData['payment_gateway_id'] = $paymentGateWayDetails->id;
                $insertData['campaign_id'] = $request->input('campaign_id');
                $insertData['receiver_public_user_id'] = $campaignDetails->public_user_id;
                $insertData['giver_public_user_id'] = $request->user?->id ?? null;
                $insertData['created_at'] = date('Y-m-d H:i:s');
                $insertData['transaction_id'] = $response->idx ?? null;
                $insertData['service_charge_percentage'] = 7;
                $insertData['payment_status'] = strtolower($response?->state?->name ?? '');
                $insertData['is_anonymous'] = 0;
                $insertData['payment_gateway_all_response'] = json_encode($response);
                $insertData['is_verified'] = 1; //by system admin manually
                $resp = Donation::insert($insertData);
                Session::flash('success', 'Congratulations. Your donation has been successfully received. Please wait for the verification.');
                return redirect()->back();
                /* donateaoro */
            } else {
                Session::flash('error', 'Sorry. Something went wrong. Please try again later or contact our support team.');
                return redirect()->back();
            }
        } catch (Throwable $th) {
            return $this->renderView($this->parentViewFolder() . '.errorpage', []);
            // Session::flash('error', 'Sorry. Something went wrong. Please try again later or contact our support team.');
            // return redirect()->back();
        }
    }

    function saveLocation(Request $request)
    {
        try {
            $data = [];
            $data['ip'] = $request->input('ip');
            $data['latitude'] = $request->input('latitude')??null;
            $data['longitude'] = $request->input('longitude')??null;
            $data['campaign_id'] = $request->input('campaign_id')??null;
            $data['created_at'] = date('Y-m-d');
            $ifExists = CampaignVisit::where('ip', $data['ip'])->where('campaign_id',$data['campaign_id'])->wheredate('created_at', date('Y-m-d'))->count();
            if (!$ifExists) {
                CampaignVisit::insert($data);
            }
            return 'true';
        } catch (Throwable $th) {
            return 'false';
        }
    }
}
