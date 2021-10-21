<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\bank;
use Illuminate\Support\Facades\DB;

class banksSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('banks')->insert(['name' => 'BANK BRI', 'code' => '002']);
            DB::table('banks')->insert(['name' => 'BANK EKSPOR INDONESIA', 'code' => '003']);
            DB::table('banks')->insert(['name'  => 'BANK BNI', 'code' => '009']);
            DB::table('banks')->insert(['name'  => 'BANK DANAMON', 'code' => '011']);
            DB::table('banks')->insert(['name'  => 'PERMATA BANK', 'code' => '013']);
            DB::table('banks')->insert(['name'  => 'BANK BCA', 'code' => '014']);
            DB::table('banks')->insert(['name'  => 'BANK BII', 'code' => '016']);
            DB::table('banks')->insert(['name'  => 'BANK PANIN', 'code' => '019']);
            DB::table('banks')->insert(['name'  => 'BANK ARTA NIAGA KENCANA', 'code' => '020']);
            DB::table('banks')->insert(['name'  => 'BANK NIAGA', 'code' => '022']);
            DB::table('banks')->insert(['name'  => 'BANK BUANA IND', 'code' => '023']);
            DB::table('banks')->insert(['name'  => 'BANK LIPPO', 'code' => '026']);
            DB::table('banks')->insert(['name'  => 'BANK NISP', 'code' => '028']);
            DB::table('banks')->insert(['name'  => 'AMERICAN EXPRESS BANK LTD', 'code' => '030']);
            DB::table('banks')->insert(['name'  => 'CITIBANK N.A.', 'code' => '031']);
            DB::table('banks')->insert(['name'  => 'JP. MORGAN CHASE BANK, N.A.', 'code' => '032']);
            DB::table('banks')->insert(['name'  => 'BANK OF AMERICA, N.A', 'code' => '033']);
            DB::table('banks')->insert(['name'  => 'ING INDONESIA BANK', 'code' => '034']);
            DB::table('banks')->insert(['name'  => 'BANK MULTICOR TBK.', 'code' => '036']);
            DB::table('banks')->insert(['name'  => 'BANK ARTHA GRAHA', 'code' => '037']);
            DB::table('banks')->insert(['name'  => 'BANK CREDIT AGRICOLE INDOSUEZ', 'code' => '039']);
            DB::table('banks')->insert(['name'  => 'THE BANGKOK BANK COMP. LTD', 'code' => '040']);
            DB::table('banks')->insert(['name'  => 'THE HONGKONG & SHANGHAI B.C.', 'code' => '041']);
            DB::table('banks')->insert(['name'  => 'THE BANK OF TOKYO MITSUBISHI UFJ LTD', 'code' => '042']);
            DB::table('banks')->insert(['name'  => 'BANK SUMITOMO MITSUI INDONESIA', 'code' => '045']);
            DB::table('banks')->insert(['name'  => 'BANK DBS INDONESIA', 'code' => '046']);
            DB::table('banks')->insert(['name'  => 'BANK RESONA PERDANIA', 'code' => '047']);
            DB::table('banks')->insert(['name'  => 'BANK MIZUHO INDONESIA', 'code' => '048']);
            DB::table('banks')->insert(['name'  => 'STANDARD CHARTERED BANK', 'code' => '050']);
            DB::table('banks')->insert(['name'  => 'BANK ABN AMRO', 'code' => '052']);
            DB::table('banks')->insert(['name'  => 'BANK KEPPEL TATLEE BUANA', 'code' => '053']);
            DB::table('banks')->insert(['name'  => 'BANK CAPITAL INDONESIA, TBK.', 'code' => '054']);
            DB::table('banks')->insert(['name'  => 'BANK BNP PARIBAS INDONESIA', 'code' => '057']);
            DB::table('banks')->insert(['name'  => 'BANK UOB INDONESIA', 'code' => '058']);
            DB::table('banks')->insert(['name'  => 'KOREA EXCHANGE BANK DANAMON', 'code' => '059']);
            DB::table('banks')->insert(['name'  => 'RABOBANK INTERNASIONAL INDONESIA', 'code' => '060']);
            DB::table('banks')->insert(['name'  => 'ANZ PANIN BANK', 'code' => '061']);
            DB::table('banks')->insert(['name'  => 'DEUTSCHE BANK AG.', 'code' => '067']);
            DB::table('banks')->insert(['name'  => 'BANK WOORI INDONESIA', 'code' => '068']);
            DB::table('banks')->insert(['name'  => 'BANK OF CHINA LIMITED', 'code' => '069']);
            DB::table('banks')->insert(['name'  => 'BANK BUMI ARTA', 'code' => '076']);
            DB::table('banks')->insert(['name'  => 'BANK EKONOMI', 'code' => '087']);
            DB::table('banks')->insert(['name'  => 'BANK ANTARDAERAH', 'code' => '088']);
            DB::table('banks')->insert(['name'  => 'BANK HAGA', 'code' => '089']);
            DB::table('banks')->insert(['name'  => 'BANK IFI', 'code' => '093']);
            DB::table('banks')->insert(['name'  => 'BANK CENTURY, TBK.', 'code' => '095']);
            DB::table('banks')->insert(['name'  => 'BANK MAYAPADA', 'code' => '097']);
            DB::table('banks')->insert(['name'  => 'BANK JABAR', 'code' => '110']);
            DB::table('banks')->insert(['name'  => 'BANK DKI', 'code' => '111']);
            DB::table('banks')->insert(['name'  => 'BPD DIY', 'code' => '112']);
            DB::table('banks')->insert(['name'  => 'BANK JATENG', 'code' => '113']);
            DB::table('banks')->insert(['name'  => 'BANK JATIM', 'code' => '114']);
            DB::table('banks')->insert(['name'  => 'BPD JAMBI', 'code' => '115']);
            DB::table('banks')->insert(['name'  => 'BPD ACEH', 'code' => '116']);
            DB::table('banks')->insert(['name'  => 'BANK SUMUT', 'code' => '117']);
            DB::table('banks')->insert(['name'  => 'BANK NAGARI', 'code' => '118']);
            DB::table('banks')->insert(['name'  => 'BANK RIAU', 'code' => '119']);
            DB::table('banks')->insert(['name'  => 'BANK SUMSEL', 'code' => '120']);
            DB::table('banks')->insert(['name'  => 'BANK LAMPUNG', 'code' => '121']);
            DB::table('banks')->insert(['name'  => 'BPD KALSEL', 'code' => '122']);
            DB::table('banks')->insert(['name'  => 'BPD KALIMANTAN BARAT', 'code' => '123']);
            DB::table('banks')->insert(['name'  => 'BPD KALTIM', 'code' => '124']);
            DB::table('banks')->insert(['name'  => 'BPD KALTENG', 'code' => '125']);
            DB::table('banks')->insert(['name'  => 'BPD SULSEL', 'code' => '126']);
            DB::table('banks')->insert(['name'  => 'BANK SULUT', 'code' => '127']);
            DB::table('banks')->insert(['name'  => 'BPD NTB', 'code' => '128']);
            DB::table('banks')->insert(['name'  => 'BPD BALI', 'code' => '129']);
            DB::table('banks')->insert(['name'  => 'BANK NTT', 'code' => '130']);
            DB::table('banks')->insert(['name'  => 'BANK MALUKU', 'code' => '131']);
            DB::table('banks')->insert(['name'  => 'BPD PAPUA', 'code' => '132']);
            DB::table('banks')->insert(['name'  => 'BANK BENGKULU', 'code' => '133']);
            DB::table('banks')->insert(['name'  => 'BPD SULAWESI TENGAH', 'code' => '134']);
            DB::table('banks')->insert(['name'  => 'BANK SULTRA', 'code' => '135']);
            DB::table('banks')->insert(['name'  => 'BANK NUSANTARA PARAHYANGAN', 'code' => '145']);
            DB::table('banks')->insert(['name'  => 'BANK SWADESI', 'code' => '146']);
            DB::table('banks')->insert(['name'  => 'BANK MUAMALAT', 'code' => '147']);
            DB::table('banks')->insert(['name'  => 'BANK MESTIKA', 'code' => '151']);
            DB::table('banks')->insert(['name'  => 'BANK METRO EXPRESS', 'code' => '152']);
            DB::table('banks')->insert(['name'  => 'BANK SHINTA INDONESIA', 'code' => '153']);
            DB::table('banks')->insert(['name'  => 'BANK MASPION', 'code' => '157']);
            DB::table('banks')->insert(['name'  => 'BANK HAGAKITA', 'code' => '159']);
            DB::table('banks')->insert(['name'  => 'BANK GANESHA', 'code' => '161']);
            DB::table('banks')->insert(['name'  => 'BANK WINDU KENTJANA', 'code' => '162']);
            DB::table('banks')->insert(['name'  => 'HALIM INDONESIA BANK', 'code' => '164']);
            DB::table('banks')->insert(['name'  => 'BANK HARMONI INTERNATIONAL', 'code' => '166']);
            DB::table('banks')->insert(['name'  => 'BANK KESAWAN', 'code' => '167']);
            DB::table('banks')->insert(['name'  => 'BANK TABUNGAN NEGARA (PERSERO)', 'code' => '200']);
            DB::table('banks')->insert(['name'  => 'BANK HIMPUNAN SAUDARA 1906, TBK .', 'code' => '21']);
            DB::table('banks')->insert(['name'  => 'BANK TABUNGAN PENSIUNAN NASIONAL', 'code' => '213']);
            DB::table('banks')->insert(['name'  => 'BANK SWAGUNA', 'code' => '405']);
            DB::table('banks')->insert(['name'  => 'BANK JASA ARTA', 'code' => '422']);
            DB::table('banks')->insert(['name'  => 'BANK MEGA', 'code' => '426']);
            DB::table('banks')->insert(['name'  => 'BANK JASA JAKARTA', 'code' => '427']);
            DB::table('banks')->insert(['name'  => 'BANK BUKOPIN', 'code' => '441']);
            DB::table('banks')->insert(['name'  => 'BANK SYARIAH MANDIRI', 'code' => '451']);
            DB::table('banks')->insert(['name'  => 'BANK BISNIS INTERNASIONAL', 'code' => '459']);
            DB::table('banks')->insert(['name'  => 'BANK SRI PARTHA', 'code' => '466']);
            DB::table('banks')->insert(['name'  => 'BANK JASA JAKARTA', 'code' => '472']);
            DB::table('banks')->insert(['name'  => 'BANK BINTANG MANUNGGAL', 'code' => '484']);
            DB::table('banks')->insert(['name'  => 'BANK BUMIPUTERA', 'code' => '485']);
            DB::table('banks')->insert(['name'  => 'BANK YUDHA BHAKTI', 'code' => '490']);
            DB::table('banks')->insert(['name'  => 'BANK MITRANIAGA', 'code' => '491']);
            DB::table('banks')->insert(['name'  => 'BANK AGRO NIAGA', 'code' => '494']);
            DB::table('banks')->insert(['name'  => 'BANK INDOMONEX', 'code' => '498']);
            DB::table('banks')->insert(['name'  => 'BANK ROYAL INDONESIA', 'code' => '501']);
            DB::table('banks')->insert(['name'  => 'BANK ALFINDO', 'code' => '503']);
            DB::table('banks')->insert(['name'  => 'BANK SYARIAH MEGA', 'code' => '506']);
            DB::table('banks')->insert(['name'  => 'BANK INA PERDANA', 'code' => '513']);
            DB::table('banks')->insert(['name'  => 'BANK HARFA', 'code' => '517']);
            DB::table('banks')->insert(['name'  => 'PRIMA MASTER BANK', 'code' => '520']);
            DB::table('banks')->insert(['name'  => 'BANK PERSYARIKATAN INDONESIA', 'code' => '521']);
            DB::table('banks')->insert(['name'  => 'BANK AKITA', 'code' => '525']);
            DB::table('banks')->insert(['name'  => 'LIMAN INTERNATIONAL BANK', 'code' => '526']);
            DB::table('banks')->insert(['name'  => 'ANGLOMAS INTERNASIONAL BANK', 'code' => '531']);
            DB::table('banks')->insert(['name'  => 'BANK DIPO INTERNATIONAL', 'code' => '523']);
            DB::table('banks')->insert(['name'  => 'BANK KESEJAHTERAAN EKONOMI', 'code' => '535']);
            DB::table('banks')->insert(['name'  => 'BANK UIB', 'code' => '536']);
            DB::table('banks')->insert(['name'  => 'BANK ARTOS IND', 'code' => '542']);
            DB::table('banks')->insert(['name'  => 'BANK PURBA DANARTA', 'code' => '547']);
            DB::table('banks')->insert(['name'  => 'BANK MULTI ARTA SENTOSA', 'code' => '548']);
            DB::table('banks')->insert(['name'  => 'BANK MAYORA', 'code' => '553']);
            DB::table('banks')->insert(['name'  => 'BANK INDEX SELINDO', 'code' => '555']);
            DB::table('banks')->insert(['name'  => 'BANK VICTORIA INTERNATIONAL', 'code' => '566']);
            DB::table('banks')->insert(['name'  => 'BANK EKSEKUTIF', 'code' => '558']);
            DB::table('banks')->insert(['name'  => 'CENTRATAMA NASIONAL BANK', 'code' => '559']);
            DB::table('banks')->insert(['name'  => 'BANK FAMA INTERNASIONAL', 'code' => '562']);
            DB::table('banks')->insert(['name'  => 'BANK SINAR HARAPAN BALI', 'code' => '564']);
            DB::table('banks')->insert(['name'  => 'BANK HARDA', 'code' => '567']);
            DB::table('banks')->insert(['name'  => 'BANK FINCONESIA', 'code' => '945']);
            DB::table('banks')->insert(['name'  => 'BANK MERINCORP', 'code' => '946']);
            DB::table('banks')->insert(['name'  => 'BANK MAYBANK INDOCORP', 'code' => '947']);
            DB::table('banks')->insert(['name'  => 'BANK OCBC – INDONESIA', 'code' => '948']);
            DB::table('banks')->insert(['name'  => 'BANK CHINA TRUST INDONESIA', 'code' => '949']);
            DB::table('banks')->insert(['name'  => 'BANK COMMONWEALTH', '950']
        );
    }
}
