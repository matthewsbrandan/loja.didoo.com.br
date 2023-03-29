<?php

return [
    'version' => '2.1.8',
    'env'=>[
        [
            'name'=>'Setup',
            'slug'=>'setup',
            'icon'=>'ni ni-settings',
            'fields'=>[
                ['separator'=>'System', 'title'=>'Project name', 'key'=>'APP_NAME', 'value'=>'Site name'],
                ['title'=>'Link to your site', 'key'=>'APP_URL', 'value'=>'https://loja.didoo.com.br/'],
                ['title'=>'Subdomains', 'key'=>'IGNORE_SUBDOMAINS', 'value'=>'www,loja', 'help'=>'Subdomain your app works in. ex if your subdomain is app.yourdomain.com, here you should have www,app '],
                ['title'=>'App debugging', 'key'=>'APP_DEBUG', 'value'=>'false', 'ftype'=>'bool', 'help'=>'Enable if you experince error 500'],
                ['title'=>'Wildcard domain', 'help'=>'If you have followed the procedure to enable wildcard domain, select this so you can have shopname.yourdomain.com', 'key'=>'WILDCARD_DOMAIN_READY', 'value'=>'false', 'ftype'=>'bool'],
                ['title'=>'Enable guest log', 'key'=>'ENABLE_GUEST_LOG', 'value'=>'true', 'ftype'=>'bool', 'onlyin'=>'qrsaas'],
                ['title'=>'Hide project branding on menu page', 'key'=>'HIDE_PROJECT_BRANDING', 'value'=>'true', 'ftype'=>'bool', 'onlyin'=>'qrsaas'],
                ['title'=>'Disable the landing page', 'help'=>'When landing page is disabled, the project will start from the login page. In this case it is best to have the system in subdomain', 'key'=>'DISABLE_LANDING', 'value'=>'false', 'ftype'=>'bool', 'onlyin'=>'qrsaas'],

                ['separator'=>'Ordering and items', 'title'=>'Completely disable ordering', 'key'=>'QRSAAS_DISABLE_ODERING', 'value'=>'false', 'ftype'=>'bool', 'onlyin'=>'qrsaas', 'help'=>'If this is selected, then cart, and orders will not be showm'],
                ['title'=>'Directly approve order', 'help'=>'When selected admin does not have to approve order', 'key'=>'APP_ORDER_APPROVE_DIRECTLY', 'value'=>'false', 'ftype'=>'bool', 'onlyin'=>'ft'],
                ['title'=>'Assign orders to drivers automatically', 'key'=>'ALLOW_AUTOMATED_ASSIGN_TO_DRIVER', 'value'=>'true', 'ftype'=>'bool', 'onlyin'=>'ft'],
                ['title'=>'Allow restaurant to do their own delivery', 'key'=>'APP_ALLOW_SELF_DELIVER', 'value'=>'true', 'ftype'=>'bool', 'onlyin'=>'ft'],
                ['title'=>'Time for order to be prepared', 'help'=>'Average time order is prepared, so users can not order before restaurant or shop is closing', 'key'=>'TIME_TO_PREPARE_ORDER_IN_MINUTES', 'value'=>0, 'type'=>'number', 'onlyin'=>'ft'],
                ['title'=>'Search radius for restaurants', 'help'=>'Maximum distance that restaurants are shown to user', 'key'=>'LOCATION_SEARCH_RADIUS', 'value'=>50, 'type'=>'number', 'onlyin'=>'ft'],
                ['title'=>'Search radius for drivers', 'help'=>'When you have automatic assign to driver, this is a way to show the system for the maximum range to look for driver', 'key'=>'DRIVER_SEARCH_RADIUS', 'value'=>15, 'type'=>'number', 'onlyin'=>'ft'],
                ['title'=>'Disable continues orders', 'help'=>'If enabled, orders done on same table will be merged, until order is not closed/finished by restaurant', 'key'=>'DISABLE_CONTINIUS_ORDERING', 'value'=>'false', 'ftype'=>'bool', 'onlyin'=>'qrsaas'],
                ['title'=>'Enable pickup , system wide', 'key'=>'ENABLE_PICKUP', 'value'=>'true', 'ftype'=>'bool'],
                ['title'=>'Hide cash on delivery, system wide', 'key'=>'HIDE_COD', 'value'=>'false', 'ftype'=>'bool'],
                ['title'=>'Delivery / time intervals in minutes', 'help'=>'Separate the time slots into N Minutes. ex 09:00-09-15 , 09:15-09:30 - value is 15 ', 'key'=>'DELIVERY_INTERVAL_IN_MINUTES', 'value'=>30, 'type'=>'number'],
                ['title'=>'Default payment type', 'key'=>'DEFAULT_PAYMENT', 'value'=>'cod', 'ftype'=>'select', 'data'=>['cod'=>'Cash on Deliver', 'stripe'=>'Stripe Card processing']],
                ['title'=>'Is your project multi city', 'help'=>'When selected, the frontpage will display list of cities', 'key'=>'MULTI_CITY', 'value'=>'true', 'ftype'=>'bool', 'onlyin'=>'ft'],
                ['title'=>'Single mode - run this site for one restaurant only', 'key'=>'SINGLE_MODE', 'value'=>'false', 'ftype'=>'bool', 'onlyin'=>'ft'],
                ['title'=>'The id of the restaurant for single mode', 'help'=>'If you have single mode selected, than this restaurant id will be showm', 'key'=>'SINGLE_MODE_ID', 'value'=>'1', 'type'=>'number', 'onlyin'=>'ft'],
                ['title'=>'Enable import via CSV for restaurant items', 'key'=>'ENABLE_IMPORT_CSV', 'value'=>'false', 'ftype'=>'bool'],

                ['title'=>'Enable call waiter button', 'help'=>'When enabled, there will be notification in the backend when user click on the button to call waiter', 'key'=>'ENABLE_CALL_WAITER', 'value'=>'true', 'ftype'=>'bool', 'onlyin'=>'qrsaas'],
                ['title'=>'Enable WhatsApp ordering', 'key'=>'IS_WHATSAPP_ORDERING_MODE', 'value'=>'false', 'type'=>'hidden', 'onlyin'=>'qrsaas'],
                ['title'=>'Driver percentage from delivery fee', 'key'=>'DRIVER_PERCENT_FROM_DELIVERY_FEE', 'value'=>100, 'type'=>'number', 'onlyin'=>'ft'],

                ['separator'=>'Delivery costs', 'title'=>'Enable cost per distance', 'key'=>'ENABLE_COST_PER_DISTANCE', 'value'=>'false', 'ftype'=>'bool', 'onlyin'=>'ft'],
                ['title'=>'Cost per kilometer', 'key'=>'COST_PER_KILOMETER', 'value'=>'1', 'onlyin'=>'ft'],
                ['title'=>'Enable cost based on range', 'help'=>'If you have enable cost based on range, the delivery cost will be calucalted based on what range the distance for delivery is in', 'key'=>'ENABLE_COST_IN_RANGE', 'value'=>'false', 'ftype'=>'bool', 'onlyin'=>'ft'],
                ['help'=>'Range in kilometers ex from 0km - 5km will be 0-5', 'title'=>'First range', 'key'=>'RANGE_ONE', 'value'=>'0-5', 'onlyin'=>'ft'],
                ['title'=>'Second range', 'key'=>'RANGE_TWO', 'value'=>'5-7', 'onlyin'=>'ft'],
                ['title'=>'Third range', 'key'=>'RANGE_THREE', 'value'=>'7-10', 'onlyin'=>'ft'],
                ['title'=>'Fourth range', 'key'=>'RANGE_FOUR', 'value'=>'10-15', 'onlyin'=>'ft'],
                ['title'=>'Fifth range', 'key'=>'RANGE_FIVE', 'value'=>'15-20', 'onlyin'=>'ft'],

                ['title'=>'Price for first range', 'key'=>'RANGE_ONE_PRICE', 'value'=>'5', 'onlyin'=>'ft'],
                ['title'=>'Price for second range', 'key'=>'RANGE_TWO_PRICE', 'value'=>'6', 'onlyin'=>'ft'],
                ['title'=>'Price for third range', 'key'=>'RANGE_THREE_PRICE', 'value'=>'8', 'onlyin'=>'ft'],
                ['title'=>'Price for fourth range', 'key'=>'RANGE_FOUR_PRICE', 'value'=>'10', 'onlyin'=>'ft'],
                ['title'=>'Price for fifth range', 'key'=>'RANGE_FIVE_PRICE', 'value'=>'15', 'onlyin'=>'ft'],

                ['title'=>'Driver percent from the order', 'help'=>'From 0-100. Based on your business type, this value determines how much driver will make from the delivery fee', 'key'=>'DRIVER_PERCENT_FROM_DELIVERY_FEE', 'value'=>'100', 'onlyin'=>'ft'],

                ['title'=>'Demo restaurant slug', 'separator'=>'Other settings', 'help'=>'Enter the domain - slug of your demo restaurant that will show on the landing page', 'key'=>'demo_restaurant_slug', 'value'=>'leukapizza', 'onlyin'=>'qrsaas'],
                ['title'=>'Url route for restaurant', 'help'=>'If you want to change the link the restaurant is open in. ex yourdomain.com/shop/shopname. shop - should be the value here', 'key'=>'URL_ROUTE', 'value'=>'restaurant'],
                ['title'=>'Print templates images', 'help'=>'Links to images representing the images for the templates. You can usae remote images', 'key'=>'templates', 'value'=>'/impactfront/img/menu_template_1.jpg,/impactfront/img/menu_template_2.jpg', 'onlyin'=>'qrsaas'],
                ['title'=>'Print templates zip', 'help'=>'Link to .zip representing the template for download. You can use remote file', 'key'=>'linkToTemplates', 'value'=>'/impactfront/img/templates.zip', 'onlyin'=>'qrsaas'],

                ['title'=>'Enable multi language menus', 'help'=>'When enabled, restaurants can add language version to the menu', 'key'=>'ENABLE_MILTILANGUAGE_MENUS', 'value'=>'false', 'ftype'=>'bool'],

                ['title'=>'Position for the register driver link', 'key'=>'DRIVER_LINK_REGISTER_POSITION', 'value'=>'footer', 'data'=>['footer'=>'Footer', 'navbar'=>'Navigation bar', 'dontshow'=>'Hidden'], 'ftype'=>'select', 'onlyin'=>'ft'],
                ['title'=>'Position for the register restaurant link', 'key'=>'RESTAURANT_LINK_REGISTER_POSITION', 'value'=>'footer', 'data'=>['footer'=>'Footer', 'navbar'=>'Navigation bar', 'dontshow'=>'Hidden'], 'ftype'=>'select', 'onlyin'=>'ft'],

                ['title'=>'Title of driver link', 'key'=>'DRIVER_LINK_REGISTER_TITLE', 'value'=>'Wanna drive for us?', 'onlyin'=>'ft'],
                ['title'=>'Title for the register restaurant link', 'key'=>'RESTAURANT_LINK_REGISTER_TITLE', 'value'=>'Add your restaurant', 'onlyin'=>'ft'],

                ['title'=>'Mobile app secret', 'key'=>'APP_SECRET', 'value'=>'APP_SECRET', 'onlyin'=>'ft'],
                ['title'=>'App environment', 'key'=>'APP_ENV', 'value'=>'local', 'ftype'=>'select', 'data'=>['local'=>'Local', 'prodcution'=>'Production']],
                ['title'=>'Debug app level', 'type'=>'hidden', 'key'=>'APP_LOG_LEVEL', 'value'=>'debug', 'data'=>['debug'=>'Debug', 'error'=>'Error']],
            ],
        ],

        [
            'name'=>'Finances',
            'slug'=>'finances',
            'icon'=>'ni ni-money-coins',
            'fields'=>[

                ['separator'=>'General', 'title'=>'Tool used for subscriptions', 'key'=>'SUBSCRIPTION_PROCESSOR', 'value'=>'Stripe', 'ftype'=>'select', 'data'=>['Stripe'=>'Stripe', 'PayPal'=>'PayPal', 'Paystack'=>'Paystack', 'Paddle'=>'Paddle', 'Local'=>'Local bank transfer'], 'onlyin'=>'qrsaas'],
                ['key'=>'ENABLE_PRICING', 'value'=>'true', 'type'=>'hidden', 'onlyin'=>'qrsaas'],
                ['title'=>'', 'key'=>'FREE_PRICING_ID', 'value'=>'1', 'type'=>'hidden', 'onlyin'=>'qrsaas'],
                ['title'=>'Enable Finance dasboard for owner', 'help'=>'More advance, finance related reports for owner', 'key'=>'ENABLE_FINANCES_OWNER', 'value'=>'true', 'ftype'=>'bool'],
                ['title'=>'Enable Finance dasboard for admin', 'key'=>'ENABLE_FINANCES_ADMIN', 'help'=>'More advance, finance related reports for admin', 'value'=>'true', 'ftype'=>'bool'],

                ['separator'=>'Stripe', 'title'=>'Enable stripe for payments when ordering', 'key'=>'ENABLE_STRIPE', 'value'=>'true', 'ftype'=>'bool'],
                ['title'=>'Stripe API key', 'key'=>'STRIPE_KEY', 'value'=>'pk_test_XXXXXXXXXXXXXX'],
                ['title'=>'Stripe API Secret', 'key'=>'STRIPE_SECRET', 'value'=>'sk_test_XXXXXXXXXXXXXXX'],
                ['title'=>'Enable Stripe connect', 'help'=>'If enabled, restaurants will be able to connect, and money to be send directly to them', 'key'=>'ENABLE_STRIPE_CONNECT', 'value'=>'true', 'ftype'=>'bool'],

                ['separator'=>'Paypal', 'title'=>'Enable paypal for payments when ordering', 'key'=>'ENABLE_PAYPAL', 'value'=>'false', 'ftype'=>'bool'],
                ['title'=>'Paypal client id', 'key'=>'PAYPAL_CLIENT_ID', 'value'=>''],
                ['title'=>'Paypal secret', 'key'=>'PAYPAL_SECRET', 'value'=>''],
                ['title'=>'Paypal mode', 'key'=>'PAYPAL_MODE', 'value'=>'sandbox', 'ftype'=>'select', 'data'=>['sandbox'=>'Development - sandbox', 'live'=>'Production - live']],

                ['separator'=>'Mollie', 'title'=>'Enable mollie for payments when ordering', 'key'=>'ENABLE_MOLLIE', 'value'=>'false', 'ftype'=>'bool'],
                ['title'=>'Mollie client key', 'key'=>'MOLLIE_KEY', 'value'=>''],

                ['separator'=>'Local bank transfer', 'title'=>'Local bank transfer explanation', 'key'=>'LOCAL_TRANSFER_INFO', 'value'=>'Wire us the plan amout on the following bank accoun. And inform us about the wire.', 'onlyin'=>'qrsaas'],
                ['title'=>'Bank Account', 'key'=>'LOCAL_TRANSFER_ACCOUNT', 'value'=>'IBAN: 12112121212121', 'onlyin'=>'qrsaas'],

                ['separator'=>'Paystack', 'title'=>'Paystak payments enabled', 'key'=>'ENABLE_PAYSTACK', 'value'=>'false', 'ftype'=>'bool'],
                ['title'=>'', 'key'=>'PAYSTACK_PUBLIC_KEY', 'value'=>''],
                ['title'=>'Secret key', 'key'=>'PAYSTACK_SECRET_KEY', 'value'=>''],
                ['title'=>'Merchant email', 'key'=>'MERCHANT_EMAIL', 'value'=>''],
                ['title'=>'Paystack payment url', 'key'=>'PAYSTACK_PAYMENT_URL', 'value'=>'https://api.paystack.co'],

                ['separator'=>'Paddle', 'title'=>'Vendor ID obtained from Paddle.com', 'key'=>'paddleVendorID', 'value'=>'', 'onlyin'=>'qrsaas'],

                ],
        ],
        [
            'name'=>'Localization',
            'slug'=>'localizatino',
            'icon'=>'ni ni-world-2',
            'fields'=>[
                ['title'=>'Default language', '', 'key'=>'APP_LOCALE', 'value'=>'en', 'ftype'=>'select', 'data'=>[
                    'af'=>'Afrikaans',
                    'ak'=>'Akan',
                    'sq'=>'Albanian',
                    'am'=>'Amharic',
                    'ar'=>'Arabic',
                    'hy'=>'Armenian',
                    'as'=>'Assamese',
                    'az'=>'Azerbaijani',
                    'bm'=>'Bambara',
                    'eu'=>'Basque',
                    'be'=>'Belarusian',
                    'bn'=>'Bengali',
                    'bs'=>'Bosnian',
                    'bg'=>'Bulgarian',
                    'my'=>'Burmese',
                    'ca'=>'Catalan',
                    'zh'=>'Chinese',
                    'kw'=>'Cornish',
                    'hr'=>'Croatian',
                    'cs'=>'Czech',
                    'da'=>'Danish',
                    'nl'=>'Dutch',
                    'en'=>'English',
                    'eo'=>'Esperanto',
                    'et'=>'Estonian',
                    'ee'=>'Ewe',
                    'fo'=>'Faroese',
                    'fi'=>'Finnish',
                    'fr'=>'French',
                    'ff'=>'Fulah',
                    'gl'=>'Galician',
                    'lg'=>'Ganda',
                    'ka'=>'Georgian',
                    'de'=>'German',
                    'el'=>'Greek',
                    'gu'=>'Gujarati',
                    'ha'=>'Hausa',
                    'he'=>'Hebrew',
                    'hi'=>'Hindi',
                    'hu'=>'Hungarian',
                    'is'=>'Icelandic',
                    'ig'=>'Igbo',
                    'id'=>'Indonesian',
                    'ga'=>'Irish',
                    'it'=>'Italian',
                    'ja'=>'Japanese',
                    'kl'=>'Kalaallisut',
                    'kn'=>'Kannada',
                    'kk'=>'Kazakh',
                    'km'=>'Khmer',
                    'ki'=>'Kikuyu',
                    'rw'=>'Kinyarwanda',
                    'ko'=>'Korean',
                    'lv'=>'Latvian',
                    'lt'=>'Lithuanian',
                    'mk'=>'Macedonian',
                    'mg'=>'Malagasy',
                    'ms'=>'Malay',
                    'ml'=>'Malayalam',
                    'mt'=>'Maltese',
                    'gv'=>'Manx',
                    'mr'=>'Marathi',
                    'ne'=>'Nepali',
                    'nd'=>'North Ndebele',
                    'nb'=>'Norwegian Bokmål',
                    'nn'=>'Norwegian Nynorsk',
                    'or'=>'Oriya',
                    'om'=>'Oromo',
                    'ps'=>'Pashto',
                    'fa'=>'Persian',
                    'pl'=>'Polish',
                    'pt'=>'Portuguese',
                    'pa'=>'Punjabi',
                    'ro'=>'Romanian',
                    'rm'=>'Romansh',
                    'ru'=>'Russian',
                    'sg'=>'Sango',
                    'sr'=>'Serbian',
                    'sn'=>'Shona',
                    'ii'=>'Sichuan Yi',
                    'si'=>'Sinhala',
                    'sk'=>'Slovak',
                    'sl'=>'Slovenian',
                    'so'=>'Somali',
                    'es'=>'Spanish',
                    'sw'=>'Swahili',
                    'sv'=>'Swedish',
                    'ta'=>'Tamil',
                    'te'=>'Telugu',
                    'th'=>'Thai',
                    'bo'=>'Tibetan',
                    'ti'=>'Tigrinya',
                    'to'=>'Tonga',
                    'tr'=>'Turkish',
                    'uk'=>'Ukrainian',
                    'ur'=>'Urdu',
                    'uz'=>'Uzbek',
                    'vi'=>'Vietnamese',
                    'cy'=>'Welsh',
                    'yo'=>'Yoruba',
                    'zu'=>'Zulu',
                ]],
                ['title'=>'List of avaialbe language on the landing page', 'help'=>'Define a list of Language shortcode and the name. If only one language is listed, the language picker will not show up', 'key'=>'FRONT_LANGUAGES', 'value'=>'EN,English,FR,French', 'onlyin'=>'qrsaas'],
                ['title'=>'Time zone', 'help'=>'This value is important for correct vendors opening and closing times', 'key'=>'TIME_ZONE', 'value'=>'Europe/Berlin', 'ftype'=>'select', 'data'=>[
                    'Pacific/Midway'=>'(UTC-11:00) Midway Island',
                    'Pacific/Samoa'=>'(UTC-11:00) Samoa',
                    'Pacific/Honolulu'=>'(UTC-10:00) Hawaii',
                    'US/Alaska'=>'(UTC-09:00) Alaska',
                    'America/Los_Angeles'=>'(UTC-08:00) Pacific Time (US &amp; Canada)',
                    'America/Tijuana'=>'(UTC-08:00) Tijuana',
                    'US/Arizona'=>'(UTC-07:00) Arizona',
                    'America/Chihuahua'=>'(UTC-07:00) Chihuahua',
                    'America/Chihuahua'=>'(UTC-07:00) La Paz',
                    'America/Mazatlan'=>'(UTC-07:00) Mazatlan',
                    'US/Mountain'=>'(UTC-07:00) Mountain Time (US &amp; Canada)',
                    'America/Managua'=>'(UTC-06:00) Central America',
                    'US/Central'=>'(UTC-06:00) Central Time (US &amp; Canada)',
                    'America/Mexico_City'=>'(UTC-06:00) Guadalajara',
                    'America/Mexico_City'=>'(UTC-06:00) Mexico City',
                    'America/Monterrey'=>'(UTC-06:00) Monterrey',
                    'Canada/Saskatchewan'=>'(UTC-06:00) Saskatchewan',
                    'America/Bogota'=>'(UTC-05:00) Bogota',
                    'US/Eastern'=>'(UTC-05:00) Eastern Time (US &amp; Canada)',
                    'US/East-Indiana'=>'(UTC-05:00) Indiana (East)',
                    'America/Lima'=>'(UTC-05:00) Lima',
                    'America/Bogota'=>'(UTC-05:00) Quito',
                    'Canada/Atlantic'=>'(UTC-04:00) Atlantic Time (Canada)',
                    'America/Caracas'=>'(UTC-04:30) Caracas',
                    'America/La_Paz'=>'(UTC-04:00) La Paz',
                    'America/Santiago'=>'(UTC-04:00) Santiago',
                    'Canada/Newfoundland'=>'(UTC-03:30) Newfoundland',
                    'America/Sao_Paulo'=>'(UTC-03:00) Brasilia',
                    'America/Argentina/Buenos_Aires'=>'(UTC-03:00) Buenos Aires',
                    'America/Argentina/Buenos_Aires'=>'(UTC-03:00) Georgetown',
                    'America/Godthab'=>'(UTC-03:00) Greenland',
                    'America/Noronha'=>'(UTC-02:00) Mid-Atlantic',
                    'Atlantic/Azores'=>'(UTC-01:00) Azores',
                    'Atlantic/Cape_Verde'=>'(UTC-01:00) Cape Verde Is.',
                    'Africa/Casablanca'=>'(UTC+00:00) Casablanca',
                    'Europe/London'=>'(UTC+00:00) Edinburgh',
                    'Etc/Greenwich'=>'(UTC+00:00) Greenwich Mean Time : Dublin',
                    'Europe/Lisbon'=>'(UTC+00:00) Lisbon',
                    'Europe/London'=>'(UTC+00:00) London',
                    'Africa/Monrovia'=>'(UTC+00:00) Monrovia',
                    'UTC'=>'(UTC+00:00) UTC',
                    'Europe/Amsterdam'=>'(UTC+01:00) Amsterdam',
                    'Europe/Belgrade'=>'(UTC+01:00) Belgrade',
                    'Europe/Berlin'=>'(UTC+01:00) Berlin',
                    'Europe/Berlin'=>'(UTC+01:00) Bern',
                    'Europe/Bratislava'=>'(UTC+01:00) Bratislava',
                    'Europe/Brussels'=>'(UTC+01:00) Brussels',
                    'Europe/Budapest'=>'(UTC+01:00) Budapest',
                    'Europe/Copenhagen'=>'(UTC+01:00) Copenhagen',
                    'Europe/Ljubljana'=>'(UTC+01:00) Ljubljana',
                    'Europe/Madrid'=>'(UTC+01:00) Madrid',
                    'Europe/Paris'=>'(UTC+01:00) Paris',
                    'Europe/Prague'=>'(UTC+01:00) Prague',
                    'Europe/Rome'=>'(UTC+01:00) Rome',
                    'Europe/Sarajevo'=>'(UTC+01:00) Sarajevo',
                    'Europe/Skopje'=>'(UTC+01:00) Skopje',
                    'Europe/Stockholm'=>'(UTC+01:00) Stockholm',
                    'Europe/Vienna'=>'(UTC+01:00) Vienna',
                    'Europe/Warsaw'=>'(UTC+01:00) Warsaw',
                    'Africa/Lagos'=>'(UTC+01:00) West Central Africa',
                    'Europe/Zagreb'=>'(UTC+01:00) Zagreb',
                    'Europe/Athens'=>'(UTC+02:00) Athens',
                    'Europe/Bucharest'=>'(UTC+02:00) Bucharest',
                    'Africa/Cairo'=>'(UTC+02:00) Cairo',
                    'Africa/Harare'=>'(UTC+02:00) Harare',
                    'Europe/Helsinki'=>'(UTC+02:00) Helsinki',
                    'Europe/Istanbul'=>'(UTC+02:00) Istanbul',
                    'Asia/Jerusalem'=>'(UTC+02:00) Jerusalem',
                    'Europe/Helsinki'=>'(UTC+02:00) Kyiv',
                    'Africa/Johannesburg'=>'(UTC+02:00) Pretoria',
                    'Europe/Riga'=>'(UTC+02:00) Riga',
                    'Europe/Sofia'=>'(UTC+02:00) Sofia',
                    'Europe/Tallinn'=>'(UTC+02:00) Tallinn',
                    'Europe/Vilnius'=>'(UTC+02:00) Vilnius',
                    'Asia/Baghdad'=>'(UTC+03:00) Baghdad',
                    'Asia/Kuwait'=>'(UTC+03:00) Kuwait',
                    'Europe/Minsk'=>'(UTC+03:00) Minsk',
                    'Africa/Nairobi'=>'(UTC+03:00) Nairobi',
                    'Asia/Riyadh'=>'(UTC+03:00) Riyadh',
                    'Europe/Volgograd'=>'(UTC+03:00) Volgograd',
                    'Asia/Tehran'=>'(UTC+03:30) Tehran',
                    'Asia/Muscat'=>'(UTC+04:00) Abu Dhabi',
                    'Asia/Baku'=>'(UTC+04:00) Baku',
                    'Europe/Moscow'=>'(UTC+04:00) Moscow',
                    'Asia/Muscat'=>'(UTC+04:00) Muscat',
                    'Europe/Moscow'=>'(UTC+04:00) St. Petersburg',
                    'Asia/Tbilisi'=>'(UTC+04:00) Tbilisi',
                    'Asia/Yerevan'=>'(UTC+04:00) Yerevan',
                    'Asia/Kabul'=>'(UTC+04:30) Kabul',
                    'Asia/Karachi'=>'(UTC+05:00) Islamabad',
                    'Asia/Karachi'=>'(UTC+05:00) Karachi',
                    'Asia/Tashkent'=>'(UTC+05:00) Tashkent',
                    'Asia/Calcutta'=>'(UTC+05:30) Chennai',
                    'Asia/Kolkata'=>'(UTC+05:30) Kolkata',
                    'Asia/Calcutta'=>'(UTC+05:30) Mumbai',
                    'Asia/Calcutta'=>'(UTC+05:30) New Delhi',
                    'Asia/Calcutta'=>'(UTC+05:30) Sri Jayawardenepura',
                    'Asia/Katmandu'=>'(UTC+05:45) Kathmandu',
                    'Asia/Almaty'=>'(UTC+06:00) Almaty',
                    'Asia/Dhaka'=>'(UTC+06:00) Astana',
                    'Asia/Dhaka'=>'(UTC+06:00) Dhaka',
                    'Asia/Yekaterinburg'=>'(UTC+06:00) Ekaterinburg',
                    'Asia/Rangoon'=>'(UTC+06:30) Rangoon',
                    'Asia/Bangkok'=>'(UTC+07:00) Bangkok',
                    'Asia/Bangkok'=>'(UTC+07:00) Hanoi',
                    'Asia/Jakarta'=>'(UTC+07:00) Jakarta',
                    'Asia/Novosibirsk'=>'(UTC+07:00) Novosibirsk',
                    'Asia/Hong_Kong'=>'(UTC+08:00) Beijing',
                    'Asia/Chongqing'=>'(UTC+08:00) Chongqing',
                    'Asia/Hong_Kong'=>'(UTC+08:00) Hong Kong',
                    'Asia/Krasnoyarsk'=>'(UTC+08:00) Krasnoyarsk',
                    'Asia/Kuala_Lumpur'=>'(UTC+08:00) Kuala Lumpur',
                    'Australia/Perth'=>'(UTC+08:00) Perth',
                    'Asia/Singapore'=>'(UTC+08:00) Singapore',
                    'Asia/Taipei'=>'(UTC+08:00) Taipei',
                    'Asia/Ulan_Bator'=>'(UTC+08:00) Ulaan Bataar',
                    'Asia/Urumqi'=>'(UTC+08:00) Urumqi',
                    'Asia/Irkutsk'=>'(UTC+09:00) Irkutsk',
                    'Asia/Tokyo'=>'(UTC+09:00) Osaka',
                    'Asia/Tokyo'=>'(UTC+09:00) Sapporo',
                    'Asia/Seoul'=>'(UTC+09:00) Seoul',
                    'Asia/Tokyo'=>'(UTC+09:00) Tokyo',
                    'Australia/Adelaide'=>'(UTC+09:30) Adelaide',
                    'Australia/Darwin'=>'(UTC+09:30) Darwin',
                    'Australia/Brisbane'=>'(UTC+10:00) Brisbane',
                    'Australia/Canberra'=>'(UTC+10:00) Canberra',
                    'Pacific/Guam'=>'(UTC+10:00) Guam',
                    'Australia/Hobart'=>'(UTC+10:00) Hobart',
                    'Australia/Melbourne'=>'(UTC+10:00) Melbourne',
                    'Pacific/Port_Moresby'=>'(UTC+10:00) Port Moresby',
                    'Australia/Sydney'=>'(UTC+10:00) Sydney',
                    'Asia/Yakutsk'=>'(UTC+10:00) Yakutsk',
                    'Asia/Vladivostok'=>'(UTC+11:00) Vladivostok',
                    'Pacific/Auckland'=>'(UTC+12:00) Auckland',
                    'Pacific/Fiji'=>'(UTC+12:00) Fiji',
                    'Pacific/Kwajalein'=>'(UTC+12:00) International Date Line West',
                    'Asia/Kamchatka'=>'(UTC+12:00) Kamchatka',
                    'Asia/Magadan'=>'(UTC+12:00) Magadan',
                    'Pacific/Fiji'=>'(UTC+12:00) Marshall Is.',
                    'Asia/Magadan'=>'(UTC+12:00) New Caledonia',
                    'Asia/Magadan'=>'(UTC+12:00) Solomon Is.',
                    'Pacific/Auckland'=>'(UTC+12:00) Wellington',
                    'Pacific/Tongatapu'=>"(UTC+13:00) Nuku'alofa",
                ]],
                ['title'=>'Default currency', 'key'=>'CASHIER_CURRENCY', 'value'=>'eur', 'ftype'=>'select', 'data'=>[
                    'AED' => 'United Arab Emirates Dirham',
                    'ALL' => 'Albania Lek',
                    'AFN' => 'Afghanistan Afghani',
                    'ARS' => 'Argentina Peso',
                    'AWG' => 'Aruba Guilder',
                    'AUD' => 'Australia Dollar',
                    'AZN' => 'Azerbaijan New Manat',
                    'BSD' => 'Bahamas Dollar',
                    'BBD' => 'Barbados Dollar',
                    'BDT' => 'Bangladeshi taka',
                    'BYR' => 'Belarus Ruble',
                    'BZD' => 'Belize Dollar',
                    'BMD' => 'Bermuda Dollar',
                    'BOB' => 'Bolivia Boliviano',
                    'BAM' => 'Bosnia and Herzegovina Convertible Marka',
                    'BWP' => 'Botswana Pula',
                    'BGN' => 'Bulgaria Lev',
                    'BRL' => 'Brazil Real',
                    'BND' => 'Brunei Darussalam Dollar',
                    'KHR' => 'Cambodia Riel',
                    'CAD' => 'Canada Dollar',
                    'KYD' => 'Cayman Islands Dollar',
                    'CLP' => 'Chile Peso',
                    'CNY' => 'China Yuan Renminbi',
                    'COP' => 'Colombia Peso',
                    'CRC' => 'Costa Rica Colon',
                    'HRK' => 'Croatia Kuna',
                    'CUP' => 'Cuba Peso',
                    'CZK' => 'Czech Republic Koruna',
                    'DKK' => 'Denmark Krone',
                    'DOP' => 'Dominican Republic Peso',
                    'XCD' => 'East Caribbean Dollar',
                    'EGP' => 'Egypt Pound',
                    'SVC' => 'El Salvador Colon',
                    'EEK' => 'Estonia Kroon',
                    'EUR' => 'Euro Member Countries',
                    'FKP' => 'Falkland Islands (Malvinas) Pound',
                    'FJD' => 'Fiji Dollar',
                    'GHC' => 'Ghana Cedis',
                    'GIP' => 'Gibraltar Pound',
                    'GTQ' => 'Guatemala Quetzal',
                    'GGP' => 'Guernsey Pound',
                    'GYD' => 'Guyana Dollar',
                    'HNL' => 'Honduras Lempira',
                    'HKD' => 'Hong Kong Dollar',
                    'HUF' => 'Hungary Forint',
                    'ISK' => 'Iceland Krona',
                    'INR' => 'India Rupee',
                    'IDR' => 'Indonesia Rupiah',
                    'IRR' => 'Iran Rial',
                    'IMP' => 'Isle of Man Pound',
                    'ILS' => 'Israel Shekel',
                    'JMD' => 'Jamaica Dollar',
                    'JPY' => 'Japan Yen',
                    'JEP' => 'Jersey Pound',
                    'KZT' => 'Kazakhstan Tenge',
                    'KPW' => 'Korea (North) Won',
                    'KRW' => 'Korea (South) Won',
                    'KGS' => 'Kyrgyzstan Som',
                    'LAK' => 'Laos Kip',
                    'LVL' => 'Latvia Lat',
                    'LBP' => 'Lebanon Pound',
                    'LRD' => 'Liberia Dollar',
                    'LTL' => 'Lithuania Litas',
                    'MKD' => 'Macedonia Denar',
                    'MYR' => 'Malaysia Ringgit',
                    'MUR' => 'Mauritius Rupee',
                    'MXN' => 'Mexico Peso',
                    'MNT' => 'Mongolia Tughrik',
                    'MZN' => 'Mozambique Metical',
                    'NAD' => 'Namibia Dollar',
                    'NPR' => 'Nepal Rupee',
                    'ANG' => 'Netherlands Antilles Guilder',
                    'NZD' => 'New Zealand Dollar',
                    'NIO' => 'Nicaragua Cordoba',
                    'NGN' => 'Nigeria Naira',
                    'NOK' => 'Norway Krone',
                    'OMR' => 'Oman Rial',
                    'PKR' => 'Pakistan Rupee',
                    'PAB' => 'Panama Balboa',
                    'PYG' => 'Paraguay Guarani',
                    'PEN' => 'Peru Nuevo Sol',
                    'PHP' => 'Philippines Peso',
                    'PLN' => 'Poland Zloty',
                    'QAR' => 'Qatar Riyal',
                    'RON' => 'Romania New Leu',
                    'RUB' => 'Russia Ruble',
                    'SHP' => 'Saint Helena Pound',
                    'SAR' => 'Saudi Arabia Riyal',
                    'RSD' => 'Serbia Dinar',
                    'SCR' => 'Seychelles Rupee',
                    'SGD' => 'Singapore Dollar',
                    'SBD' => 'Solomon Islands Dollar',
                    'SOS' => 'Somalia Shilling',
                    'ZAR' => 'South Africa Rand',
                    'LKR' => 'Sri Lanka Rupee',
                    'SEK' => 'Sweden Krona',
                    'CHF' => 'Switzerland Franc',
                    'SRD' => 'Suriname Dollar',
                    'SYP' => 'Syria Pound',
                    'TWD' => 'Taiwan New Dollar',
                    'THB' => 'Thailand Baht',
                    'TTD' => 'Trinidad and Tobago Dollar',
                    'TRY' => 'Turkey Lira',
                    'TRL' => 'Turkey Lira',
                    'TVD' => 'Tuvalu Dollar',
                    'UAH' => 'Ukraine Hryvna',
                    'GBP' => 'United Kingdom Pound',
                    'USD' => 'United States Dollar',
                    'UYU' => 'Uruguay Peso',
                    'UZS' => 'Uzbekistan Som',
                    'VEF' => 'Venezuela Bolivar',
                    'VND' => 'Viet Nam Dong',
                    'YER' => 'Yemen Rial',
                    'ZWD' => 'Zimbabwe Dollar',
                ]],
                ['title'=>'Money conversion', 'help'=>'Some currencies need this field to be unselected. By default it should be selected', 'key'=>'DO_CONVERTION', 'value'=>'true', 'ftype'=>'bool'],
                ['title'=>'Time format', 'key'=>'TIME_FORMAT', 'value'=>'AM/PM', 'ftype'=>'select', 'data'=>['AM/PM'=>'AM/PM', '24hours '=>'24 Hours']],
                ['title'=>'Date and time display', 'key'=>'DATETIME_DISPLAY_FORMAT', 'value'=>'d M Y h:i A'],

            ],
        ],
        [
            'name'=>'Plugins',
            'slug'=>'plugins',
            'icon'=>'ni ni-ui-04',
            'fields'=>[

                ['separator'=>'Google plugins', 'title'=>'Recaptcha site key', 'help'=>"Make empty if you can't make submition on register screen", 'key'=>'RECAPTCHA_SITE_KEY', 'value'=>''],
                ['title'=>'Recaptcha secret', 'help'=>"Make empty if you can't make submition on register screen", 'key'=>'RECAPTCHA_SECRET_KEY', 'value'=>''],
                ['title'=>'Google maps api key', 'key'=>'GOOGLE_MAPS_API_KEY', 'value'=>''],
                ['title'=>'Enable location search', 'key'=>'ENABLE_LOCATION_SEARCH', 'value'=>'false', 'ftype'=>'bool', 'onlyin'=>'ft'],
                ['title'=>'Google analytics key', 'key'=>'GOOGLE_ANALYTICS', 'value'=>''],
                ['separator'=>'Login services', 'title'=>'Google client id for sign in', 'key'=>'GOOGLE_CLIENT_ID', 'value'=>'', 'onlyin'=>'ft'],
                ['title'=>'Google client secret for sign in', 'key'=>'GOOGLE_CLIENT_SECRET', 'value'=>'', 'onlyin'=>'ft'],
                ['title'=>'Google redirect link for sign in', 'key'=>'GOOGLE_REDIRECT', 'value'=>'', 'onlyin'=>'ft'],
                ['title'=>'Facebook client id', 'key'=>'FACEBOOK_CLIENT_ID', 'value'=>'', 'onlyin'=>'ft'],
                ['title'=>'Facebook client secret', 'key'=>'FACEBOOK_CLIENT_SECRET', 'value'=>'', 'onlyin'=>'ft'],
                ['title'=>'Facebook redirec', 'key'=>'FACEBOOK_REDIRECT', 'value'=>'', 'onlyin'=>'ft'],
                ['separator'=>'Notifications', 'title'=>'Onesignal App id', 'key'=>'ONESIGNAL_APP_ID', 'value'=>''],
                ['title'=>'Onesignal rest api key', 'key'=>'ONESIGNAL_REST_API_KEY', 'value'=>''],
                ['title'=>'Twillo Account SID', 'key'=>'TWILIO_ACCOUNT_SID', 'value'=>'SID', 'onlyin'=>'ft'],
                ['title'=>'Twillo Account auth token', 'key'=>'TWILIO_AUTH_TOKEN', 'value'=>'TOKEN', 'onlyin'=>'ft'],
                ['title'=>'Twillo from number', 'key'=>'TWILIO_FROM', 'value'=>'NUMBER', 'onlyin'=>'ft'],
                ['title'=>'System should send sms notifications', 'key'=>'SEND_SMS_NOTIFICATIONS', 'value'=>'false', 'ftype'=>'bool', 'onlyin'=>'ft'],
                ['separator'=>'Pusher live notifications', 'title'=>'Pusher app id', 'help'=>'Pusher is used for notification for call waiter and new orders avaialbe', 'key'=>'PUSHER_APP_ID', 'value'=>''],
                ['title'=>'Pusher app key', 'key'=>'PUSHER_APP_KEY', 'value'=>''],
                ['title'=>'Pusher app secret', 'key'=>'PUSHER_APP_SECRET', 'value'=>''],
                ['title'=>'Pusher app cluster', 'key'=>'PUSHER_APP_CLUSTER', 'value'=>'eu'],
                ['title'=>'Broadcast Driver', 'key'=>'BROADCAST_DRIVER', 'value'=>'log', 'ftype'=>'select', 'data'=>['log'=>'Log', 'pusher'=>'Pusher']],

                ['separator'=>'Share this', 'title'=>'Share this property id', 'help'=>'You can find this number in Share this import link', 'key'=>'SHARE_THIS_PROPERTY', 'value'=>''],
                ['separator'=>'Futy', 'title'=>'Futy key', 'key'=>'FUTY_KEY', 'value'=>''],

            ],
        ],
        [
            'name'=>'SMTP',
            'slug'=>'smtp',
            'icon'=>'ni ni-email-83',
            'fields'=>[
                ['title'=>'Mail driver', 'key'=>'MAIL_MAILER', 'value'=>'smtp', 'ftype'=>'select', 'data'=>['smtp'=>'SMTP', 'sendmail'=>'PHP Sendmail - best of port 465']],
                ['title'=>'Host', 'key'=>'MAIL_HOST', 'value'=>'smtp.mailtrap.io', 'hint'=>'Your SMTP send server'],
                ['title'=>'Port', 'key'=>'MAIL_PORT', 'value'=>'2525', 'help'=>'Common ports are 26, 465, 587'],
                ['title'=>'Encryption', 'key'=>'MAIL_ENCRYPTION', 'value'=>'', 'ftype'=>'select', 'data'=>['null'=>'Null - best for port 26', ''=>'None - best for port 587', 'ssl'=>'SSL - best for port 465']],

                ['title'=>'Username', 'key'=>'MAIL_USERNAME', 'value'=>'802fc656dd8029'],
                ['title'=>'Password', 'key'=>'MAIL_PASSWORD', 'value'=>'bbcf39d313eac6'],
                ['title'=>'From address', 'key'=>'MAIL_FROM_ADDRESS', 'value'=>'bd5d577b7c-be3ae1@inbox.mailtrap.io'],
                ['title'=>'From Name', 'key'=>'MAIL_FROM_NAME', 'value'=>'Your Site'],

                ['title'=>'', 'key'=>'DB_CONNECTION', 'value'=>'mysql', 'data'=>['mysql'=>'MySql'], 'type'=>'hidden'],
                ['title'=>'', 'key'=>'DB_HOST', 'value'=>'127.0.0.1', 'hint'=>'Your SMTP send server', 'type'=>'hidden'],
                ['title'=>'', 'key'=>'DB_PORT', 'value'=>'3306', 'type'=>'hidden'],
                ['title'=>'', 'key'=>'DB_DATABASE', 'value'=>'laravel', 'type'=>'hidden'],
                ['title'=>'', 'key'=>'DB_USERNAME', 'value'=>'laravel', 'type'=>'hidden'],
                ['title'=>'', 'key'=>'DB_PASSWORD', 'value'=>'laravel', 'type'=>'hidden'],

                ['title'=>'', 'key'=>'CACHE_DRIVER', 'value'=>'file', 'type'=>'hidden'],
                ['title'=>'', 'key'=>'SESSION_DRIVER', 'value'=>'file', 'type'=>'hidden'],
                ['title'=>'', 'key'=>'QUEUE_DRIVER', 'value'=>'sync', 'type'=>'hidden'],
                ['title'=>'', 'key'=>'REDIS_HOST', 'value'=>'127.0.0.1', 'type'=>'hidden'],
                ['title'=>'', 'key'=>'REDIS_PASSWORD', 'value'=>'null', 'type'=>'hidden'],
                ['title'=>'', 'key'=>'REDIS_PORT', 'value'=>'6379', 'type'=>'hidden'],

            ],
        ],
    ],
];
