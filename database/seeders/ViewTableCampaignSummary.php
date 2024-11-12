<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ViewTableCampaignSummary extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::select("CREATE OR REPLACE VIEW campaigns_summary_view AS
SELECT cmp.id,
       cmp.user_id,
       cmp.title,
       cmp.slug,
       cmp.description,
       cmp.start_date,
       cmp.end_date,
       cmp.goal_amount,
       cmp.campaign_status,
       cmp.status,
       cmp.is_featured,
       cmp.campaign_category_id,
       cmp.cover_image,
       COALESCE(SUM(don.amount), 0) AS summary_total_collection,
       COALESCE(SUM(don.amount - ((don.amount * don.service_charge_percentage) / 100)), 0) AS net_amount_collection,
       COALESCE(COUNT(cv.campaign_id), 0) AS total_visits,
       COALESCE(SUM((don.amount * don.service_charge_percentage) / 100), 0) AS summary_service_charge_amount,
       COALESCE(COUNT(don.id), 0) AS total_number_donation
FROM campaigns cmp
LEFT JOIN donations don ON don.campaign_id = cmp.id AND don.payment_status = 'completed'
LEFT JOIN campaign_visits cv ON cv.campaign_id = cmp.id
GROUP BY cmp.id, cmp.user_id, cmp.title, cmp.slug, cmp.description, cmp.start_date, cmp.end_date, cmp.goal_amount, cmp.campaign_status, cmp.status, cmp.is_featured, cmp.campaign_category_id, cmp.cover_image;

        ");
    }
}
