<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\PostCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{
    public function run()
    {
        $pages = [
            ['title' => 'FAQ', 'body' => "<p>1. What is crowdfunding?</p>
                            <p>Crowdfunding is a way for individuals and businesses to raise money for their projects or ventures by collecting small contributions from a large number of people, typically via an online platform.</p>
                            <p>2. How does crowdfunding work?</p>
                            <p>Crowdfunding works by creating a campaign on a platform like ours, setting a funding goal, and then inviting people to contribute money to support the project. If the funding goal is reached, the funds are typically released to the campaign creator.</p>
                            <p>3. What types of projects can I crowdfund on this platform?</p>
                            <p>Our platform supports a wide range of projects, including creative endeavors, startups, charitable causes, personal fundraisers, and more. Please review our guidelines to ensure your project is eligible.</p>
                            <p>4. Is my project guaranteed to get funded?</p>
                            <p>No, funding is not guaranteed. It depends on the quality of your campaign, your marketing efforts, and whether or not it resonates with potential contributors. Successful crowdfunding campaigns often require careful planning and promotion.</p>
                            <p>5. How do I create a crowdfunding campaign?</p>
                            <p>To create a campaign, sign up on our platform, fill out the required information, and follow the steps provided in our campaign creation process. You'll need to set a funding goal, create a compelling pitch, and offer rewards or incentives to contributors.</p>
                            <p>6. What fees are associated with using this platform?</p>
                            <p>We typically charge a platform fee, or proccesing fee which is a percentage of the funds raised. These fees are required to pay for wallet service provider, bank transfers, our server and running costs,etc. The processing fee is 10 percentage of fund raised. However on special request, we might not charge our plateform fee but payment gateway fee will charged as per payment gateway's standard.</p>
                            <p>7. What payment methods can contributors use to support a campaign?</p>
                            <p>Contributors can typically use credit/debit cards or other payment methods accepted by our payment processing partners. Currently our platform supports Esewa,Khalti, Bank Transfer and offline cash/cheque collection.</p>
                            <p>8. What happens if my campaign doesn't reach its funding goal?</p>
                            <p>If your campaign doesn't reach its goal, you can still receive funds collected.</p>
                            <p>9. How do I promote my crowdfunding campaign?</p>
                            <p>Promotion is crucial to the success of your campaign. You can use social media, email marketing, press releases, and other strategies to reach your target audience. We also provide tools and resources to help you market your campaign effectively.</p>
                            <p>10. Is crowdfunding regulated?<br>- Yes, crowdfunding is subject to regulations in many countries. We comply with these regulations to ensure a safe and secure crowdfunding environment. Be aware of the rules and regulations that apply to your campaign based on your location.</p>
                            <p>11. How do I contact customer support for assistance?<br>- If you have questions or encounter issues with your campaign or our platform, you can contact our customer support team through the contact information provided on our website. Quick Info: email:hello@donatepur.com, number:9702276627</p>
                            <p>12. What happens if a campaign turns out to be fraudulent or misleading?<br>- We take fraud seriously and have measures in place to address such situations. If you suspect a campaign is fraudulent or misleading, please report it to our team, and we will investigate.</p>
                            <p>13. Can I support multiple campaigns on the platform?<br>- Yes, you can support multiple campaigns on our platform. Each campaign you support will be processed individually.</p>
                            <p>14. Can I cancel my campaign before meeting deadline?<br>- Currently we do not support cancellation of campaign before deadline. You have to wait for the campaign to be end as per provided end date.</p>
                            <p>15. Can I withdraw fund raised before meeting deadline?<br>- Currently we do not support withdrawing fund raised &nbsp;before deadline. You have to wait for the campaign to be end as per provided end date.</p>"],
            [
                'title' => 'How it works',
                'body' => <<<HTML
                            <p>&nbsp;</p>
                            <p>We operate based on the following principles:</p>
                            <p>1. Signup &amp; Login: A user must create an account to create a campaign.</p>
                            <p>2. Donation Eligibility: Both logged-in and non-logged-in users can make donations in our system. The campaign should be in an active status to accept donations.</p>
                            <p>3. Creation of a Campaign: An individual or organization creates a campaign by going to their dashboard. They outline their project or cause, set a funding goal, and specify a deadline for achieving it.</p>
                            <p>4. Public or Donor Contributions: The campaign is made public, and both the general public and potential donors are invited to contribute funds towards the cause. Donors can choose to donate any amount they wish, ranging from Nrs.10 to Nrs.10,00,000.</p>
                            <p>5. Fundraising Period: The campaign remains active for a specified period. During this time, donors can make contributions towards the campaign.</p>
                            <p>6. Online Donation Support: Currently, the platform supports online donations. This means that donors can contribute funds through payment gateways like Esewa, Khalti, and Bank Transfer.</p>
                            <p>7. Offline Donation Support: Currently, the platform supports offline donations. This means that donors can contribute funds through offline methods such as bank transfers, checks, or in-person payments. Offline donations are manually verified by our support team, so it may take 1-3 days to be reflected in our system.</p>
                            <p>8. Goal or Deadline Achievement: Once the campaign reaches its deadline, the campaign creator can proceed to the next step, i.e., withdrawing the collected donations into the campaign creator's account.</p>
                            <p>9. Withdrawal Process: The campaign creator can initiate a withdrawal request for the collected amount. The platform facilitates the transfer of the funds from the campaign account to the designated recipient, typically the campaign creator. Campaign creators can withdraw using Esewa, Khalti, and Bank transfer.</p>
                            <p>10. Processing Time: The withdrawal process takes approximately 1-5 days to complete. During this time, the platform verifies the withdrawal request and ensures the funds are transferred securely.</p>
                            <p>In summary, our platform allows anyone to create a campaign, and creators can appeal to a large number of people for small donations to support things like helping others (social causes), personal needs (personal causes), or any other good reasons. It's a way to collect money from a large group of people online.</p>
                            HTML
            ],
            ['title' => 'Terms and conditions', 'body' => "<p><strong>Terms and Conditions&nbsp;</strong></p>
                            <p><strong>&nbsp;Introduction</strong></p>
                            <p>Welcome to Donatepur - The Place of Hopes, hereinafter referred to as 'the Platform'. By using the Platform, you agree to abide by these Terms and Conditions. The Platform reserves the right to modify these terms at any time, and you should review them regularly.</p>
                            <p><strong>User Registration</strong></p>
                            <p>Users must register an account to use the Platform. Users agree to provide accurate and up-to-date information during the registration process.</p>
                            <p><strong>Project Creation</strong></p>
                            <p>Users can create crowdfunding projects on the Platform. Projects must comply with our guidelines and policies. The Platform may review and approve or reject projects at its discretion.</p>
                            <p>Campaign creators have the ability to edit or delete campaign information, but only when the campaign is in a 'pending'' status.</p>
                            <p>Once a campaign starts running, the creator will no longer be able to edit or delete its information but can request to force complete the campaign.</p>
                            <p><strong>&nbsp;Fundraising</strong></p>
                            <p>Users can contribute funds to projects on the Platform. The Platform will collect funds and distribute them to project creators upon successful funding completion. A minimum of a 7% platform charge and payment processing charge will be applicable on withdrawal. Platform charges may increase as per new rules and regulations of the payment gateway we are using.</p>
                            <p><strong>Project Completion</strong></p>
                            <p>Project creators must fulfill their promises and rewards to backers. The Platform is not responsible for project fulfillment but may facilitate communication between creators and backers. To be verified and able to withdraw, users must upload citizenship, license, passport, or any other valid government documents. Users' accounts should be fully verified to withdraw amounts. There are no any hidden charges.</p>
                            <p><strong>Payment Gateways</strong></p>
                            <p>Users should enter their valid payment gateways, either Khalti or a bank account. Users can insert up to 2 payment gateways. Payment processing time may take up to 1-5 days, depending on the payment gateway.</p>
                            <p><strong>User Conduct</strong></p>
                            <p>Users must not engage in illegal, fraudulent, or harmful activities on the Platform. Prohibited activities include spamming, harassment, and intellectual property violations. Users attempting to engage in fraudulent activity will be banned permanently and might have to face legal actions as per the nature of their actions.</p>
                            <p><strong>Handling of Deceased User's Funds</strong></p>
                            <p>In the event of the campaign creator's demise, their closest family members can claim the collected funds in that campaign. Please make sure to consult with a legal professional to ensure that these terms and conditions are in full compliance with relevant laws and regulations in your jurisdiction.</p>"],
            ['title' => 'Privacy Policies', 'body' => "<p>This Privacy Policy outlines how Donatepur - The Place of Hopes, referred to as 'the Platform,' collects, uses, and protects your personal information when you use our services. By using the Platform, you agree to the terms and conditions outlined in this Privacy Policy.</p>
                            <p><strong>&nbsp;Information Collection</strong></p>
                            <p>When you use the Platform, we may collect the following information:</p>
                            <p>- Information provided during user registration, including your name, email address, and other relevant details.<br>- Information related to crowdfunding projects, which may include project descriptions and details.<br>- Financial information, including payment details and transaction history.<br>- Information required for user verification, such as citizenship, license, passport, or government-issued documents.</p>
                            <p><strong>Information Use</strong></p>
                            <p>We use the collected information for the following purposes:</p>
                            <p>- User registration and account management.<br>- Facilitating crowdfunding projects, including the collection and distribution of funds.<br>- Verifying user identities for withdrawal purposes.<br>- Communication between project creators and backers.<br>- Monitoring and enforcing user conduct as per our terms and conditions.</p>
                            <p><strong>Information Sharing</strong></p>
                            <p>We may share your personal information with the following entities:</p>
                            <p>- Payment gateways you provide (e.g., Khalti or a bank) for the purpose of processing financial transactions.<br>- Relevant authorities if required to comply with legal obligations or to address fraudulent activities.</p>
                            <p><strong>Data Security</strong></p>
                            <p>We take appropriate measures to protect your personal information from unauthorized access, disclosure, or alteration. These measures include data encryption and access controls.</p>
                            <p><strong>User Choices and Access</strong></p>
                            <p>You have the right to access, update, or delete your personal information. You can manage your information through your account settings.</p>
                            <p><strong>Policy Changes</strong></p>
                            <p>We reserve the right to modify this Privacy Policy at any time. Any changes will be communicated to you, and it is advisable to review this policy regularly.</p>
                            <p><strong>Contact Us</strong></p>
                            <p>If you have any questions or concerns about this Privacy Policy or the handling of your personal information, please contact us at:&nbsp; <span style='background-color: rgb(53, 152, 219); color: rgb(251, 238, 184);'>https://donatepur.com/contact-us</span></p>
                            <p>By using our services, you acknowledge that you have read and understood this Privacy Policy and consent to the collection and use of your personal information as described herein. It's important to ensure that this privacy policy complies with relevant laws and regulations in your jurisdiction.</p>"],
        ];

        foreach ($pages as $page) {
            $data =
                [
                    'title' => $page['title'],
                    'body' => $page['body'],
                    'slug' => Str::slug($page['title'])
                ];
            Page::firstOrCreate(
                $data
            );
        }
    }
}
