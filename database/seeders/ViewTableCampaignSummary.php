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
       cmp.description,
       cmp.start_date,
       cmp.end_date,
       cmp.goal_amount,
       cmp.campaign_status,
       cmp.status,
       cmp.is_featured,

       (SELECT SUM(amount)
        FROM donations
        WHERE campaign_id = cmp.id
          AND payment_status = 'completed') AS summary_total_collection,

       (SELECT FLOOR(SUM(don.amount - ((don.amount * don.service_charge_percentage) / 100)))
        FROM donations AS don
        WHERE don.campaign_id = cmp.id
          AND don.payment_status = 'completed') AS net_amount_collection,

       (SELECT COUNT(id)
        FROM campaign_visits
        WHERE campaign_id = cmp.id) AS total_visits,

       (SELECT FLOOR(SUM(((don.amount * don.service_charge_percentage) / 100)))
        FROM donations AS don
        WHERE don.campaign_id = cmp.id
          AND don.payment_status = 'completed') AS summary_service_charge_amount,

       (SELECT COUNT(id)
        FROM donations
        WHERE campaign_id = cmp.id
          AND payment_status = 'completed') AS total_number_donation
FROM campaigns cmp
GROUP BY cmp.id, cmp.user_id, cmp.title, cmp.description, cmp.start_date, cmp.end_date, cmp.goal_amount, cmp.campaign_status,cmp.status,cmp.is_featured;

        ");
    }
}
