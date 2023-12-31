<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencies')->insert([
            ['name' => 'Euro', 'code' => 'EUR', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Afghanistan Afghani', 'code' => 'AFN', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Albania Lek', 'code' => 'ALL', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Algerian dinar', 'code' => 'DZD', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Angolan kwanza', 'code' => 'AOA', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Argentina Peso', 'code' => 'ARS', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Armenian Dram', 'code' => 'AMD', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Aruba Guilder', 'code' => 'AWG', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Australian Dollar', 'code' => 'AUD', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Azerbaijan Manat', 'code' => 'AZN', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Bahamas Dollar', 'code' => 'BSD', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Bahraini Dinar', 'code' => 'BHD', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Bangladeshi Taka', 'code' => 'BDT', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Barbados Dollar', 'code' => 'BBD', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Belarus Ruble', 'code' => 'BYN', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Belize Dollar', 'code' => 'BZD', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Bermuda Dollar', 'code' => 'BMD', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'The ngultrum', 'code' => 'BTN', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Bolivia Bolíviano', 'code' => 'BOB', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Bosnia and Herzegovina Convertible Mark', 'code' => 'BAM', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Botswana Pula', 'code' => 'BWP', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Brazil Real', 'code' => 'BRL', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Brunei Darussalam Dollar', 'code' => 'BND', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Bulgaria Lev', 'code' => 'BGN', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Burundian franc', 'code' => 'BIF', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Canada Dollar', 'code' => 'CAD', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Cape Verdean escudo', 'code' => 'CVE', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Cayman Islands Dollar', 'code' => 'KYD', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Chilean peso', 'code' => 'CLP', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Chinese Yuan', 'code' => 'CYN', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Colombian peso', 'code' => 'COP', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Comorian franc', 'code' => 'KMF', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Costa Rica Colon', 'code' => 'CRC', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Cuba Peso', 'code' => 'CUP', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Czech Republic Koruna', 'code' => 'CZK', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Denmark Krone', 'code' => 'DKK', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Djiboutian franc', 'code' => 'DJF', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Dominican Republic Peso', 'code' => 'DOP', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Congolese franc', 'code' => 'CDF', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Egypt Pound', 'code' => 'EGP', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'El Salvador Colon', 'code' => 'SVC', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Eritrean nakfa', 'code' => 'ERN', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'The kroon', 'code' => 'EEK', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Swazi lilangeni', 'code' => 'SZL', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Ethiopian birr', 'code' => 'ETB', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Falkland Islands Pound', 'code' => 'FKP', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Fiji Dollar', 'code' => 'FJD', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'French Pacific Franc,', 'code' => 'XPF', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Dalasi', 'code' => 'GMD', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'The lari', 'code' => 'GEL', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Ghana Cedi', 'code' => 'GHS', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Gibraltar Pound', 'code' => 'GIP', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Guatemala Quetzal', 'code' => 'GTQ', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Guernsey Pound', 'code' => 'GGP', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Guinean franc', 'code' => 'GNF', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Guyana Dollar', 'code' => 'GYD', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Haitian Gourde', 'code' => 'HTG', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Honduras Lempira', 'code' => 'HNL', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Hong Kong Dollar', 'code' => 'HKD', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Hungary Forint', 'code' => 'HUF', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Iceland Krona', 'code' => 'ISK', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'India Rupee', 'code' => 'INR', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Indonesia Rupiah', 'code' => 'IDR', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Iran Rial', 'code' => 'IRR', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Iraqi dinar', 'code' => 'IQD', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Isle of Man Pound', 'code' => 'IMP', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Israel Shekel', 'code' => 'ILS', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Jamaica Dollar', 'code' => 'JMD', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Japan Yen', 'code' => 'JPY', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Jersey Pound', 'code' => 'JEP', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Jordanian dinar', 'code' => 'JOD', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Kazakhstan Tenge', 'code' => 'KZT', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Kenyan shilling', 'code' => 'KES', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Kuwaiti Dinar', 'code' => 'KWD', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Kyrgyzstan Som', 'code' => 'KGS', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Laos Kip', 'code' => 'LAK', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Lebanon Pound', 'code' => 'LBP', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Lesotho loti', 'code' => 'LSL', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Liberia Dollar', 'code' => 'LRD', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Libyan dinar', 'code' => 'LYD', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'The Swiss franc', 'code' => 'CHF', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Macanesepataca', 'code' => 'MOP', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Malagasy ariary', 'code' => 'MGA', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Malawian kwacha', 'code' => 'MWK', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Malaysia Ringgit', 'code' => 'MYR', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Maldivian Rufiyaa', 'code' => 'MVR', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'CFA franc', 'code' => 'XAF', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Mauritanian Ouguiya', 'code' => 'MRO', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Mauritius Rupee', 'code' => 'MUR', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Mexico Peso', 'code' => 'MXN', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Moldovan Leu', 'code' => 'MDL', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Mongolia Tughrik', 'code' => 'MNT', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Mozambique Metical', 'code' => 'MZN', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Myanmar Kyat', 'code' => 'MMK', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Namibia Dollar', 'code' => 'NAD', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Nepal Rupee', 'code' => 'NPR', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Nicaragua Cordoba', 'code' => 'NIO', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Nigeria Naira', 'code' => 'NGN', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Korea (North) Won', 'code' => 'KPW', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Macedonia Denar', 'code' => 'MKD', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Turkish Lira', 'code' => 'TL', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Norway Krone', 'code' => 'NOK', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Venezuelan Bolívar', 'code' => 'VEF', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Oman Rial', 'code' => 'OMR', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Pakistan Rupee', 'code' => 'PKR', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Panama Balboa', 'code' => 'PAB', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Papua New Guinean Kina', 'code' => 'PGK', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Paraguay Guarani', 'code' => 'PYG', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Peru Sol', 'code' => 'PEN', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Philippines Peso', 'code' => 'PHP', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Poland Zloty', 'code' => 'PLN', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Qatar Riyal', 'code' => 'QAR', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Romania Leu', 'code' => 'RON', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Russia Ruble', 'code' => 'RUB', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Rwandan franc', 'code' => 'RWF', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'East Caribbean Dollar', 'code' => 'XCD', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'The Samoan Tālā', 'code' => 'WST', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'São Tomé and Príncipe dobra', 'code' => 'STN', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Saudi Arabia Riyal', 'code' => 'SAR', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Serbia Dinar', 'code' => 'RSD', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Seychelles Rupee', 'code' => 'SCR', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Leon', 'code' => 'SLL', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Singapore Dollar', 'code' => 'SGD', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Antillean guilder', 'code' => 'ANG', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Solomon Islands Dollar', 'code' => 'SBD', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Somalia Shilling', 'code' => 'SOS', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'South Africa Rand', 'code' => 'ZAR', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'South Korean Won', 'code' => 'KRW', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'South Sudanese pound', 'code' => 'SSP', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Sri Lanka Rupee', 'code' => 'LKR', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Sudanese pound', 'code' => 'SDG', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Suriname Dollar', 'code' => 'SRD', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Sweden Krona', 'code' => 'SEK', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Syria Pound', 'code' => 'SYP', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Taiwan New Dollar', 'code' => 'TWD', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Tajikistani Somoni', 'code' => 'TJS', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Tanzanian shilling', 'code' => 'TZS', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Thailand Baht', 'code' => 'THB', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'CFA Franc', 'code' => 'XOF', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'New Zealand Dollar', 'code' => 'NZD', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Tongan Pa\'anga', 'code' => 'TOP', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Trinidad and Tobago Dollar', 'code' => 'TTD', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Tunisian Dinar', 'code' => 'TND', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Turkey Lira', 'code' => 'TRY', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Turkmenistan New Manat', 'code' => 'TMT', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Tuvalu Dollar', 'code' => 'TVD', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Ugandan shilling', 'code' => 'UGX', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Ukraine Hryvnia', 'code' => 'UAH', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'UAE-Dirham', 'code' => 'AED', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'United Kingdom Pound', 'code' => 'GBP', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'United States Dollar', 'code' => 'USD', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Uruguay Peso', 'code' => 'UYU', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Uzbekistan Som', 'code' => 'UZS', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'The vatu', 'code' => 'VUV', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Viet Nam Dong', 'code' => 'VND', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Moroccan Dirham', 'code' => 'MAD', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Yemen Rial', 'code' => 'YER', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Zambian Kwacha', 'code' => 'ZMW', 'rate' => 1.0, 'symbol' => ''],
            ['name' => 'Zimbabwe Dollar', 'code' => 'ZWD', 'rate' => 1.0, 'symbol' => ''],
        ]);
    }
}
