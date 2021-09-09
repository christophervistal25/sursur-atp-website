<?php

use Illuminate\Database\Seeder;
use App\Office;

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $offices = [
          
        '10001|Provincial Governor\'s Office|1011|PGO|ALEXANDER T. PIMENTEL|Provincial Governor',
        '10002|Provincial Vice Governor\'s Office|1021-01|PVGO|LIBRADO C. NAVARRO|Provincial Vice Governor ',
        '10003|Tanggapan ng Sangguniang Panlalawigan - 1|1021-02|TSP|LIBRADO C. NAVARRO|Provincial Vice Governor',
        '10004|Provincial Administrator\'s Office|1031|PADMO|PEDRO M. TRINIDAD, JR.|Department Head',
        '10005|Provincial Accountant\'s Office|1081|PAO|CONSUELO L. GARCIA|OIC-Provincial Accountant ',
        '10006|Provincial Treasurer\'s Office|1091|PTO|FERMINA D. PALANGPANG|Acting Provincial Treasurer',
        '10007|Provincial Assessor\'s Office|1101|PASSO|SABINA C. NOGUERA, REA|Acting Provincial Assessor',
        '10008|Provincial Planning and Development Office|1041|PPDO|MERLINDA O. BAURE|Department Head',
        '10009|Provincial Budget Office|1071|PBO|JOSE GREGG O. BANDOY|Provincial Budget Officer',
        '10010|Provincial General Services Office - Admin|1061|PGSO|PEDRITO M. SERRA|Provincial Government Department Head',
        '10011|Provincial Legal Office|1131|PLO|ATTY. LIMUEL L. AUZA|Department Head',
        '10012|Provincial Prosecutor\'s Office|1141-01|PPO|ATTY.VITO T. GOTOSTOS|Oic-Provincial Prosecutor',
        '10013|Provincial Engineer\'s Office - Admin Division|8751-01|PEOADM|"ENGR. ELEUTERIO S. CUBERO, JR."|Provincial Engineer',
        '10014|Provincial Agriculturist\'s Office|8711-00|PAGO|MARCOS M. QUICO|Provincial Agriculturist',
        '10015|Provincial Veterinary Office|8721|PVO|DR. GERVACIO A. YPARRAGUIRRE|Provincial Veterinarian',
        '10016|Provincial Fisheries and Aquatic Resources Office|8711-01|PFARO|BERNESITA P. ROJAS|Provincial Fisheries & Aquatic Resources Officer',
        '10017|Provincial Environment and Natural Resources Office|8731|PENRO|THELMA S. ALCOBERES|PENRO - LGU',
        '10018|Provincial Social Welfare and Development Office|7611|PSWDO|CHARLITA G. MONTENEGRO|Provincial Government Head',
        '10019|Provincial Health Office|4411-01|PHO|ERIC T. MONTESCLAROS,  M.D.|Provincial Health Officer Ii',
        '10020|Bislig District Hospital|4411-07|BDH|ELENILA I. JAKOSALEM, M.D, MCH|Chief Of Hospital',
        '10021|Hinatuan District Hospital|4411-03|HDH|DANILO J. VIOLA, M.D., MCH|Chief Of Hospital 1',
        '10022|Lianga District Hospital|4411-05|LDH|JOSENITA C. QUISIL, M.D. MCH|Department Head',
        '10023|Madrid District Hospital|4411-02|MDH|ALGERICO H. IRIZARI, M.D.|Chief Of Hospital',
        '10024|Marihatag District Hospital|4411-04|MARDH|EDMUND L. LAMELA,  MD,MDH|Chief Of  Hospital I',
        '10025|Lingig Medicare Community Hospital|4411-08|LMCH|JULIUS E. BASTILLADA, M.D.|Chief of Hospital',
        '10026|Cortes Municipal Hospital|4411-09|CMH|LIBETH H. ONGAYO, M.D.|Officer-in-charge',
        '10027|San Miguel Community Hospital|4411-06|SMCH|SYLVA F. DIME, M,D.|Chief Of Hospital',
        '10028|Provincial Tourism Office|1011-04|PPTO|MARY VIL C. CHAN|Provincial Tourism Officer',
        '10029|PGO - Nutrition Division|1011-01|PND|ERMELINDA C. ASCAREZ, RND|Department Head',
        '10030|PGO - Population Management Division|1011-02|POM|JOSE A. POLINAR|Pp0 Iv',
        '10031|PGO - Warden Tandag|1011-03|PWT|ROGELIO M. PIMENTEL|Provincial Warden',
        '10032|PGO - Warden Lianga|1011-03|PWL|ROGELIO M. PIMENTEL|Provincial Warden',
        '10033|PGO - Warden Bislig|1011-03|PWB|ROGELIO M. PIMENTEL|Provincial Warden',
        '10034|PGO - Warden Cantilan|1011-03|PWC|ROGELIO M. PIMENTEL|Provincial Warden',
        '10035|PEO - Construction and Maintenance Division 1|8751-02|PEOCMD|ENGR. ELEUTERIO S. CUBERO, JR.|Provincial Engineer',
        '10036|PEO - Motorpool Division|8751-03|PEOMPD|ENGR. ELEUTERIO S. CUBERO, JR.|Provincial Engineer',
        '10037|TSP - Coterminous|1021-02|TSP-CO|MANUEL O. ALAMEDA, SR|Vice Governor',
        '10038|TSP - Elected|1021-02|TSP-EL|LIBRADO C. NAVARRO|Provincial Vice Governor',
        '10039|Provincial School Board|NULL|PSB|FE C. VALEROSO, CESO IV|School Division Superintendent',
        '10040|Provincial General Services Office - Security|1061|PGSO|PEDRITO M. SERRA| Department Head',
        '10041|Provincial General Services Office - Detailed|1061|PGSO|PEDRITO M. SERRA| Department Head',
        '10042|PEO - Construction and Maintenance Division 2|8751-02|PEOCMD|ENGR. ELEUTERIO S. CUBERO, JR|Provincial Engineer',
        '10043|DECS|3310|DECS|ALEXANDER T. PIMENTEL.|Provincial Governor',
        '10044|ITU - Information Technology Unit|12345|ITU|RAMON R. MORALES|Cao Ii',
        '10045|Provincial Vice Governor\'s Office - VM|1021-01|PVGO-VM|LIBRADO C. NAVARRO|Provincial Vice Governor ',
        '10046|Provincial Disaster Risk Reduction & Mngt. Office|9991-100|PDRRMO|ABEL L. DE GUZMAN|Pdrrm Officer',
        '10050|Provincial Human Resource Management Office|1032|PHRMO|ACE R. ORCULLO|Provincial Government Department Head',
        '10055|Tanggapan ng Sangguniang Panlalawigan - 2|1021-02|TSP|LIBRADO C. NAVARRO|Provincial Vice Governor',
        '10056|TSP - Elected(ATM)|1021-02|TSP-EL|LIBRADO C. NAVARRO|Provincial Vice Governor',

        ];

        foreach($offices as $office) {
            list($office_code, $name, $function_code, $short, $head, $position_name) = explode('|', $office);
            Office::create([
                'office_code'   => $office_code,
                'name'          => $name,
                'function_code' => (int) $function_code,
                'short'         => $short,
                'head'          => $head ,
                'position_name' => $position_name,
            ]);
        }
        
    }
}
