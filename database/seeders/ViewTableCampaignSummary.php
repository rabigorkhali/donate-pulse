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
        SELECT *,(select sum(amount) from donations where campaign_id=cmp.id and payment_status='completed') as summary_total_collection
        ,
        (SELECT FLOOR(SUM(don.amount - ((don.amount * don.service_charge_percentage) / 100))) from donations as don where campaign_id=cmp.id and payment_status='completed')
         as net_amount_collection
         ,
         (select count(id) from campaign_visits where campaign_id=cmp.id) as total_visits
         ,
         (SELECT FLOOR(SUM(((don.amount * don.service_charge_percentage) / 100))) from donations as don where campaign_id=cmp.id and payment_status='completed')
         as summary_service_charge_amount
         ,
         (select count(id) from donations where campaign_id=cmp.id and payment_status='completed') as total_number_donation
        FROM campaigns cmp
        ")
        ;
    }
}
