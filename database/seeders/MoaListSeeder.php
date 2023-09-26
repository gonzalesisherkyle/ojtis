<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MoaListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [   
                'company_name' => 'SIMBAYANAN ni Maria Multi-purpose Cooperative', 
                'company_address' => '115 Pres. MLQ St., 1632 Taguig, Metro Manila',
                'company_contact_person' => 'Ms. Maricar I. Hernandez',
                'company_contact_person_position' => 'Pres./CEO'
            ],
            [
                'company_name' => 'NeoDocto', 
                'company_address' => '5th Flr. TRIFECTA Adatto, 21, ITPL Main Rd., Bengaluru, 560066 +91 91115 31114',
                'company_contact_person' => 'Dr. Phani Bhushan Sanneerappa',
                'company_contact_person_position' => 'Global VP and CFO '
            ],
            [
                'company_name' => 'Knowles Training Institute', 
                'company_address' => 'Temasek Boulevard, One, #12-07 Suntec Tower, Singapore 038987',
                'company_contact_person' => 'Mr. Mark Erick Cabral',
                'company_contact_person_position' => 'IT Support'
            ],
            [
                'company_name' => 'Talent Avenue PH Mangaement Inc.', 
                'company_address' => '1105 OMM Citra Bldg. San Miguel Ave., Ortigas Center, Pasig City Philippines',
                'company_contact_person' => 'Mr. Chester Troy G, Garcia',
                'company_contact_person_position' => 'Vice President'
            ],
            [
                'company_name' => 'Agrotonomy Corporation', 
                'company_address' => '825 Subshine Ln. Sedon, AZ 86336',
                'company_contact_person' => 'Ms. Fredam T. Azuela',
                'company_contact_person_position' => 'Office Administrator'
            ],
            [
                'company_name' => 'Microfuse Technologies', 
                'company_address' => '#14 Hur St. Annex 35, Betterliving, Parañaque City ',
                'company_contact_person' => 'Mrs.Charisse Joyce A. Cerillano',
                'company_contact_person_position' => 'Managing Director'
            ],
            [
                'company_name' => 'Information Managers Inc.', 
                'company_address' => 'Rm 704 State Condominium 1, 186 Salcedo St., Makati 1200',
                'company_contact_person' => 'Mr. Carlos Lim',
                'company_contact_person_position' => 'VP Admin & Finance'
            ],
            [
                'company_name' => 'Reverse Marketing Corporation', 
                'company_address' => '605 T. Santiago St., Lingunan, Valenzuela City, Metro Manila, 1446 Philippines',
                'company_contact_person' => 'Therese Emriz F. Atienza',
                'company_contact_person_position' => 'Co-founder & Chief Creative Officer'
            ],
            [
                'company_name' => 'Purple Ink PH', 
                'company_address' => '#002 Unit B., St, John St., St. Andrew Village 1, Brgy San Andres, Cainta Rizal',
                'company_contact_person' => 'Sue Jose',
                'company_contact_person_position' => 'Digital Content Creator, Social Media Specialist, Marketing, PR & Events Consultant'
            ],
            [
                'company_name' => 'Green Pasture', 
                'company_address' => '17th Flr., OMM_Citra Bldg., San. Miguel Ave., Pasig City',
                'company_contact_person' => 'Mrs., Matilde B. Ortiz',
                'company_contact_person_position' => 'HR & Operations Manager'
            ],
            [
                'company_name' => 'MVN Photostudios Events and Workshops ', 
                'company_address' => 'Blk. 165 Lot 13, Central Bicutan, Taguig City',
                'company_contact_person' => 'Engr. Czar P. Castro',
                'company_contact_person_position' => 'General Manager'
            ],
            [
                'company_name' => 'LOCKEY.COM.AU PTY LTD', 
                'company_address' => '2 Kirrang St., Wareemba NSW 2046, Australia ',
                'company_contact_person' => 'Ms. Fredam T. Azuela',
                'company_contact_person_position' => 'Office Administrator'
            ],
            [
                'company_name' => 'TATERS Enterprises, Inc.', 
                'company_address' => '3536 Hilario St., Palanan, Makati City 1235',
                'company_contact_person' => 'Elena S. De Castro',
                'company_contact_person_position' => 'Treasurer & HR OIC'
            ],
            [
                'company_name' => 'Bulaon Animal Bite Center (Anti Rabies Clinic)', 
                'company_address' => 'Bulaon Resettlement, City of San Fernando, Pampanga',
                'company_contact_person' => 'Ms. Kreychel Habon M. Cruz',
                'company_contact_person_position' => 'Supervisor'
            ],
            [
                'company_name' => 'SMS Philippines Healthcare Solutions Inc. ', 
                'company_address' => '10C Chatham House Condominiums, 116 Valero cor. V.A. Rufino Sts Salcedo Village, Makati City',
                'company_contact_person' => 'Ms. Mary Grace Dino-Panti',
                'company_contact_person_position' => ''
            ],
            [
                'company_name' => 'RPO Japan (Lewis Personnel Japan)', 
                'company_address' => 'Cattleya Bldg, #236 Salcedo St., Legaspi Village, Makati City',
                'company_contact_person' => 'Ms. Jaica Ferrer',
                'company_contact_person_position' => ''
            ],
            
            [
                'company_name' => 'Capgemini Phils. Corporation', 
                'company_address' => '12th Flr TenWest Campus Bldg., Mckinley West, Fort Bonifacio, Taguig City',
                'company_contact_person' => 'Ms. Christine Joy Manicad',
                'company_contact_person_position' => 'Country Talent Acquisition Lead, FS'
            ],
            [
                'company_name' => 'Northern Star Energy Corporation', 
                'company_address' => '3F CAP Bldg., 126 Amorsolo St., Legaspi Village, Makati City',
                'company_contact_person' => 'Ms. Rachel Ann I. Kho',
                'company_contact_person_position' => 'HR Manager'
            ],
            [
                'company_name' => 'NETGLOBAL Solutions Inc.', 
                'company_address' => '#59 West Capitol Driver, Corner Stella Maris, Brgy. Kapitolyo, Pasig City',
                'company_contact_person' => 'Jennifer Palma',
                'company_contact_person_position' => 'Developer Manager'
            ],
            [
                'company_name' => 'ROC.PH Digital Marketing Services', 
                'company_address' => 'Blk. 98 Lot 25 Beaumont St. Village 3 Metro South Subdivision, Gen. Trias, Cavite 4107 Philippines',
                'company_contact_person' => 'Mr. Ron Oliver Clarin',
                'company_contact_person_position' => 'Gen. Manager'
            ],
            [
                'company_name' => 'Bicutan Prochial School', 
                'company_address' => 'M.L. Quezon St., Lower Bicutan, Taguig City',
                'company_contact_person' => 'Ms. Jenilou R. Casareno', 
                'company_contact_person_position' => 'OIC Principal'
            ],
            [
                'company_name' => 'St. Luke\'s Medical Center (Global City) Inc.-Human Resources - Talent Acquisition Dept.', 
                'company_address' => 'Rizal Drive Corner 32nd Street and 5th Avenue, Bonifacio Global City, Taguig City',
                'company_contact_person' => 'Ms. Maria Luisa E. Sana',
                'company_contact_person_position' => 'Dept. Manager'
            ],
        ];
        DB::table('moa_lists')->insert($data);
    }
}
