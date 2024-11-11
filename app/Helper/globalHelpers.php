<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

function authUser()
{
    return Auth::user();
}


function generateToken($length)
{
    return bin2hex(openssl_random_pseudo_bytes($length));
}

function localDatetime($dateTime)
{
    return Carbon::parse($dateTime)->timezone('Asia/Kathmandu');
}


function paginate()
{
    return Config::get('constants.PAGINATE');
}

function pageIndex($items)
{
    $sn = 0;
    if (method_exists($items, 'perPage') && method_exists($items, 'currentPage')) {
        $sn = $items->perPage() * ($items->currentPage() - 1);
    }

    return $sn;
}

function SN($sn, $key)
{
    return $sn += $key + 1;
}

function getSystemPrefix()
{
    return env('SYSTEM_PREFIX', 'system');
}

function getImageUploadFirstLevelPath()
{
    return env('IMAGE_UPLOAD_PATH', 'uploads');
}

function getConfigTableData()
{
    return \App\Models\Config::first();
}

function modules()
{
    $modules = Config::get('cmsConfig.modules');
    return $modules;
}

function isPermissionSelected($permission, $permissions)
{
    $permission = json_decode($permission);
    $permissions = json_decode($permissions);
    $check = false;
    if (!is_array($permission)) {
        if ($permissions != null) {
            $exists = in_array($permission, $permissions);
            if ($exists) {
                $check = true;
            }
        }
    } else {
        $temCheck = false;
        if ($permissions != null) {
            foreach ($permission as $perm) {
                $exists = in_array($perm, $permissions);
                if ($exists) {
                    $temCheck = true;
                }
            }
        }
        $check = $temCheck;
    }

    return $check;
}

function hasPermission($url, $method = 'get')
{
    if (!authUser()) {
        return false;
    }
    $role = authUser()->role;
    $method = strtolower($method);
    $splittedUrl = explode('/' . getSystemPrefix(), $url);
    if (count($splittedUrl) > 1) {
        $url = $splittedUrl[1];
    } else {
        $url = $splittedUrl[0];
    }

    if ($role->id == 1) {
        $permissionDeniedToSuperUserRoutes = Config::get('cmsConfig.permissionDeniedToSuperUserRoutes');
        $checkDeniedRoute = true;
        foreach ($permissionDeniedToSuperUserRoutes as $route) {
            if (\Str::is($route['url'], $url) && $route['method'] == $method) {
                $checkDeniedRoute = false;
            }
        }

        return $checkDeniedRoute;
    }

    $permissionIgnoredUrls = Config::get('cmsConfig.permissionGrantedbyDefaultRoutes');

    $check = false;

    foreach ($permissionIgnoredUrls as $piurl) {
        if (\Str::is($piurl['url'], $url) && $piurl['method'] == $method) {
            $check = true;
        }
    }
    if ($check) {
        return true;
    }

    $permissions = $role->permissions;

    if ($permissions == null) {
        return false;
    }

    // foreach ($permissions as $piurl) {
    //     if (\Str::is($piurl['url'], $url) && $piurl['method'] == $method) {
    //         $check = true;
    //     }
    // }

    foreach ($permissions as $piurl) {
        if (fnmatch($piurl['url'], $url, FNM_PATHNAME) && $piurl['method'] == $method) {
            $check = true;
            break;
        }
    }
    if ($check) {
        return true;
    }

    return false;
}

function hasPermissionOnModule($module)
{
    $check = false;
    if (!$module['hasSubmodules']) {
        $check = hasPermission($module['route']);
    } else {
        try {
            foreach ($module['submodules'] as $submodule) {
                /* added third level */
                if (!$submodule['hasSubmodules']) {
                    /* after end third level if only two levels */
                    $check = hasPermission($submodule['route']);
                    if ($check == true) {
                        break;
                    }
                    /**/
                } else {
                    try {
                        foreach ($submodule['submodules'] as $childModule) {
                            $check = hasPermission($childModule['route']);
                            if ($check == true) {
                                break;
                            }
                        }
                    } catch (\Exception $e) {
                        return false;
                    }
                }
                /* end third level */
            }
        } catch (\Exception $e) {
            return false;
        }
    }

    return $check;
}

function cssIndexProgramColorsRandom()
{
    $colors = ["green", "blue", "purple", "pink", "black"];
    return $colors[array_rand($colors)];
}

use Intervention\Image\ImageManagerStatic;

function uploadImage($dir, $input, $resize = false, $width = '', $height = '')
{
    $directory = public_path() . '/' . $dir;
    if (is_dir($directory) != true) \File::makeDirectory($directory, $mode = 0775, true);
    $fileName = uniqid();
    $fileThumbnail = $fileName . '-medium.' . Request::file($input)->getClientOriginalExtension();;
    $fileSmall = $fileName . '-small.' . Request::file($input)->getClientOriginalExtension();;
    $fileName = $fileName . '.' . Request::file($input)->getClientOriginalExtension();
    $image = ImageManagerStatic::make(Request::file($input));
    $image->orientate();
    if ($resize) {
        $image = $image->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
    }

    $image->save($directory . '/' . $fileName, 100);

    /* THUMBNAIL */
    $directoryThumbnail = public_path() . '/' . $dir;
    if (is_dir($directoryThumbnail) != true) \File::makeDirectory($directoryThumbnail, $mode = 0775, true);
    $imageThumbnail = Image::make(Request::file($input));
    $imageThumbnail = $image->resize(500, 500, function ($constraintThumbnail) {
        $constraintThumbnail->aspectRatio();
    });
    $imageThumbnail->save($directoryThumbnail . '/' . $fileThumbnail, 50);
    /* THUMBNAIL */


    /* small */
    $directoryThumbnail = public_path() . '/' . $dir;
    if (is_dir($directoryThumbnail) != true) \File::makeDirectory($directoryThumbnail, $mode = 0775, true);
    $imageSmall = Image::make(Request::file($input));
    $imageSmall = $image->resize(70, null, function ($constraintThumbnail) {
        $constraintThumbnail->aspectRatio();
    });
    $imageSmall->save($directoryThumbnail . '/' . $fileSmall, 50);


    return $fileName;
}

function removeImage($dir)
{
    $f1 = $dir;
    $f2 = str_replace('.', '-medium.', $f1);
    $f3 = str_replace('.', '-small.', $f1);
    File::delete(public_path() . '/' . $f1);
    File::delete(public_path() . '/' . $f2);
    File::delete(public_path() . '/' . $f3);
}

function getCampaignStatus()
{
    return [
        "pending" => "Pending",
        "accepted" => "Accepted",
        "running" => "Running",
        "rejected" => "Rejected",
        "stopped" => "Stopped",
        "completed" => "Completed",
        "withdrawn" => "Withdrawn"
    ];
}

function permittedCampaigns()
{
    return \App\Models\Campaign::where('user_id', authUser()->id)->pluck('id');
}

function withdrawalStatus()
{
    return [
        'pending' => 'Pending',
        'cancelled' => 'Cancelled',
        'rejected' => 'Rejected',
        'successful' => 'Successful',
    ];
}

function imageName($filename, $imageType = '', $size = '100x100', $text = 'Image not found.')
{
    // http://placehold.it/430x240
    if (!$filename) {
        return 'https://dummyimage.com/' . $size . '&text=' . $text;
    }
    $extensionIndex = strrpos($filename, '.');
    $newFilename = substr_replace($filename, $imageType, $extensionIndex, 0);

    return $newFilename;
}

function numberPriceFormat($input)
{
    $formatted = number_format($input);
    $formatted = 'Rs.' . $formatted;
    return $formatted;
}


function priceToNprFormat($string)
{
    try {
        $string = explode('.', $string)[0];
        $string = strrev($string);
        $length = strlen($string);
        $newCharacter = '';
        for ($i = 0; $i < $length; $i++) {
            $character = $string[$i];
            if ($i == 3) {
                $newCharacter = $newCharacter . ',' . $character;
            } else if ($i == 5) {
                $newCharacter = $newCharacter . ',' . $character;
            } else if ($i == 7) {
                $newCharacter = $newCharacter . ',' . $character;
            } else if ($i == 9) {
                $newCharacter = $newCharacter . ',' . $character;
            } else {
                $newCharacter = $newCharacter . $character;
            }
        }
        if (!$newCharacter) {
            return 'Rs. 0';
        }
        return 'Rs.' . strrev($newCharacter);
    } catch (Throwable $th) {
        return 0;
    }
}


function replaceSpacesWithDash($inputString)
{
    $result = preg_replace('/\s+/', '-', $inputString);
    return $result;
}

function frontendActiveButton($routeNameParam = '')
{
    $routeName = Route::currentRouteName();
    if ($routeName == $routeNameParam) {
        return 'active';
    }
    return '';
}

function calculatePercentageMaxTo100($number, $total)
{
    if ($total != 0) {
        $percentage = ($number / $total) * 100;
        if ($percentage > 100) {
            return 100;
        }
        $res = round($percentage, 3);
        if ($res <= 1) {
            return 1;
        }
        return $res;
    } else {
        return 0;
    }
}

function calculateActualPercentage($number, $total)
{
    if ($total != 0) {
        $percentage = ($number / $total) * 100;
        return $percentage;
    } else {
        return 0;
    }
}


function getDaysDiffByToday($givenDate)
{
    // Create DateTime objects for today and the given date
    $today = new DateTime();
    $date = new DateTime($givenDate);

    // Calculate the difference between the two dates
    $interval = $today->diff($date);

    // Get the number of days from the difference
    $days = $interval->days;

    return $days;
}

function getDaysDiffByTwoDate($date1, $date2)
{
    // Create DateTime objects for today and the given date
    $fromDate = new DateTime($date1);
    $toDate = new DateTime($date2);

    // Calculate the difference between the two dates
    $interval = $fromDate->diff($toDate);

    // Get the number of days from the difference
    $days = $interval->days;

    if ($days <= 0) return '0';

    return $days;
}


function giveImageName($imageName, $imagegenerateType)
{
    return str_replace('.', '-' . $imagegenerateType . '.', $imageName);
}


function generateUniqueID()
{
    // Get the current timestamp with microseconds for finer granularity
    $timestamp = microtime(true);

    // Convert the timestamp to a string without decimal point
    $timestampString = str_replace('.', '', (string)$timestamp);

    // Generate a random component (you can use other methods to generate random strings)
    $randomComponent = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 6);

    // Concatenate the timestamp and random component to form the unique ID
    $uniqueID = $timestampString . $randomComponent;

    return $uniqueID;
}

function getSiteDetails($siteType = 'Site')
{
    $siteDetails = Setting::where('group', $siteType)->get();
    $siteArray = [];
    foreach ($siteDetails as $key => $datumSiteDetails) {
        $siteArray[$datumSiteDetails->key] = $datumSiteDetails->value;
    }
    return $siteArray;
}

function getPostsBlogs($limit = '5')
{
    $posts = \App\Models\Post::where('status', 'published')->orderby('created_at', 'desc')->limit($limit)->get();
    return $posts;
}

function getCounties()
{
    $countries = [
        'afghanistan' => 'Afghanistan',
        'albania' => 'Albania',
        'algeria' => 'Algeria',
        'american_samoa' => 'American Samoa',
        'andorra' => 'Andorra',
        'angola' => 'Angola',
        'anguilla' => 'Anguilla',
        'antigua_and_barbuda' => 'Antigua and Barbuda',
        'argentina' => 'Argentina',
        'armenia' => 'Armenia',
        'aruba' => 'Aruba',
        'australia' => 'Australia',
        'austria' => 'Austria',
        'azerbaijan' => 'Azerbaijan',
        'bahamas' => 'Bahamas',
        'bahrain' => 'Bahrain',
        'bangladesh' => 'Bangladesh',
        'barbados' => 'Barbados',
        'belarus' => 'Belarus',
        'belgium' => 'Belgium',
        'belize' => 'Belize',
        'benin' => 'Benin',
        'bermuda' => 'Bermuda',
        'bhutan' => 'Bhutan',
        'bolivia' => 'Bolivia',
        'bosnia_and_herzegovina' => 'Bosnia and Herzegovina',
        'botswana' => 'Botswana',
        'brazil' => 'Brazil',
        'brunei' => 'Brunei',
        'bulgaria' => 'Bulgaria',
        'burkina_faso' => 'Burkina Faso',
        'burundi' => 'Burundi',
        'cambodia' => 'Cambodia',
        'cameroon' => 'Cameroon',
        'canada' => 'Canada',
        'cape_verde' => 'Cape Verde',
        'cayman_islands' => 'Cayman Islands',
        'central_african_republic' => 'Central African Republic',
        'chad' => 'Chad',
        'chile' => 'Chile',
        'china' => 'China',
        'colombia' => 'Colombia',
        'comoros' => 'Comoros',
        'congo' => 'Congo',
        'costa_rica' => 'Costa Rica',
        'croatia' => 'Croatia',
        'cuba' => 'Cuba',
        'cyprus' => 'Cyprus',
        'czech_republic' => 'Czech Republic',
        'denmark' => 'Denmark',
        'djibouti' => 'Djibouti',
        'dominica' => 'Dominica',
        'dominican_republic' => 'Dominican Republic',
        'ecuador' => 'Ecuador',
        'egypt' => 'Egypt',
        'el_salvador' => 'El Salvador',
        'equatorial_guinea' => 'Equatorial Guinea',
        'eritrea' => 'Eritrea',
        'estonia' => 'Estonia',
        'ethiopia' => 'Ethiopia',
        'fiji' => 'Fiji',
        'finland' => 'Finland',
        'france' => 'France',
        'gabon' => 'Gabon',
        'gambia' => 'Gambia',
        'georgia' => 'Georgia',
        'germany' => 'Germany',
        'ghana' => 'Ghana',
        'greece' => 'Greece',
        'greenland' => 'Greenland',
        'grenada' => 'Grenada',
        'guam' => 'Guam',
        'guatemala' => 'Guatemala',
        'guinea' => 'Guinea',
        'guyana' => 'Guyana',
        'haiti' => 'Haiti',
        'honduras' => 'Honduras',
        'hong_kong' => 'Hong Kong',
        'hungary' => 'Hungary',
        'iceland' => 'Iceland',
        'india' => 'India',
        'indonesia' => 'Indonesia',
        'iran' => 'Iran',
        'iraq' => 'Iraq',
        'ireland' => 'Ireland',
        'israel' => 'Israel',
        'italy' => 'Italy',
        'jamaica' => 'Jamaica',
        'japan' => 'Japan',
        'jordan' => 'Jordan',
        'kazakhstan' => 'Kazakhstan',
        'kenya' => 'Kenya',
        'kiribati' => 'Kiribati',
        'kuwait' => 'Kuwait',
        'kyrgyzstan' => 'Kyrgyzstan',
        'laos' => 'Laos',
        'latvia' => 'Latvia',
        'lebanon' => 'Lebanon',
        'lesotho' => 'Lesotho',
        'liberia' => 'Liberia',
        'libya' => 'Libya',
        'liechtenstein' => 'Liechtenstein',
        'lithuania' => 'Lithuania',
        'luxembourg' => 'Luxembourg',
        'macau' => 'Macau',
        'madagascar' => 'Madagascar',
        'malawi' => 'Malawi',
        'malaysia' => 'Malaysia',
        'maldives' => 'Maldives',
        'mali' => 'Mali',
        'malta' => 'Malta',
        'marshall_islands' => 'Marshall Islands',
        'mauritania' => 'Mauritania',
        'mauritius' => 'Mauritius',
        'mexico' => 'Mexico',
        'micronesia' => 'Micronesia',
        'moldova' => 'Moldova',
        'monaco' => 'Monaco',
        'mongolia' => 'Mongolia',
        'montenegro' => 'Montenegro',
        'morocco' => 'Morocco',
        'mozambique' => 'Mozambique',
        'myanmar' => 'Myanmar',
        'namibia' => 'Namibia',
        'nauru' => 'Nauru',
        'nepal' => 'Nepal',
        'netherlands' => 'Netherlands',
        'new_zealand' => 'New Zealand',
        'nicaragua' => 'Nicaragua',
        'niger' => 'Niger',
        'nigeria' => 'Nigeria',
        'north_korea' => 'North Korea',
        'norway' => 'Norway',
        'oman' => 'Oman',
        'pakistan' => 'Pakistan',
        'palau' => 'Palau',
        'panama' => 'Panama',
        'papua_new_guinea' => 'Papua New Guinea',
        'paraguay' => 'Paraguay',
        'peru' => 'Peru',
        'philippines' => 'Philippines',
        'poland' => 'Poland',
        'portugal' => 'Portugal',
        'qatar' => 'Qatar',
        'romania' => 'Romania',
        'russia' => 'Russia',
        'rwanda' => 'Rwanda',
        'saint_kitts_and_nevis' => 'Saint Kitts and Nevis',
        'saint_lucia' => 'Saint Lucia',
        'saint_vincent_and_the_grenadines' => 'Saint Vincent and the Grenadines',
        'samoa' => 'Samoa',
        'san_marino' => 'San Marino',
        'saudi_arabia' => 'Saudi Arabia',
        'senegal' => 'Senegal',
        'serbia' => 'Serbia',
        'seychelles' => 'Seychelles',
        'sierra_leone' => 'Sierra Leone',
        'singapore' => 'Singapore',
        'slovakia' => 'Slovakia',
        'slovenia' => 'Slovenia',
        'solomon_islands' => 'Solomon Islands',
        'somalia' => 'Somalia',
        'south_africa' => 'South Africa',
        'south_korea' => 'South Korea',
        'spain' => 'Spain',
        'sri_lanka' => 'Sri Lanka',
        'sudan' => 'Sudan',
        'suriname' => 'Suriname',
        'sweden' => 'Sweden',
        'switzerland' => 'Switzerland',
        'syria' => 'Syria',
        'taiwan' => 'Taiwan',
        'tajikistan' => 'Tajikistan',
        'tanzania' => 'Tanzania',
        'thailand' => 'Thailand',
        'togo' => 'Togo',
        'tonga' => 'Tonga',
        'trinidad_and_tobago' => 'Trinidad and Tobago',
        'tunisia' => 'Tunisia',
        'turkey' => 'Turkey',
        'turkmenistan' => 'Turkmenistan',
        'tuvalu' => 'Tuvalu',
        'uganda' => 'Uganda',
        'ukraine' => 'Ukraine',
        'united_arab_emirates' => 'United Arab Emirates',
        'united_kingdom' => 'United Kingdom',
        'united_states' => 'United States',
        'uruguay' => 'Uruguay',
        'uzbekistan' => 'Uzbekistan',
        'vanuatu' => 'Vanuatu',
        'vatican_city' => 'Vatican City',
        'venezuela' => 'Venezuela',
        'vietnam' => 'Vietnam',
        'yemen' => 'Yemen',
        'zambia' => 'Zambia',
        'zimbabwe' => 'Zimbabwe'
    ];
    return $countries;
}

 function paymentGateways()
 {
     return[
         'khalti'=>'Khalti',
         'bank'=>'Bank'
     ];
 }

