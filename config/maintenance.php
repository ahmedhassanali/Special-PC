<?php

return [
    'components' => [
        'intel_cpu' => [
            'Intel Core i3-12100', 'Intel Core i3-13100', 'Intel Core i3-14100',
            'Intel Core i5-12400', 'Intel Core i5-12600K', 'Intel Core i5-13400', 'Intel Core i5-13600K', 'Intel Core i5-14400', 'Intel Core i5-14600K',
            'Intel Core i7-12700K', 'Intel Core i7-13700K', 'Intel Core i7-14700K',
            'Intel Core i9-12900K', 'Intel Core i9-13900K', 'Intel Core i9-14900K',
            'Intel Core Ultra 5', 'Intel Core Ultra 7', 'Intel Core Ultra 9',
        ],
        'amd_cpu' => [
            'AMD Ryzen 5 5500', 'AMD Ryzen 5 5600', 'AMD Ryzen 5 7600', 'AMD Ryzen 5 7600X', 'AMD Ryzen 5 8600G', 'AMD Ryzen 5 9600X',
            'AMD Ryzen 7 5700X', 'AMD Ryzen 7 5800X3D', 'AMD Ryzen 7 7700', 'AMD Ryzen 7 7800X3D', 'AMD Ryzen 7 8700G', 'AMD Ryzen 7 9700X', 'AMD Ryzen 7 9800X3D',
            'AMD Ryzen 9 5900X', 'AMD Ryzen 9 5950X', 'AMD Ryzen 9 7900X', 'AMD Ryzen 9 7950X', 'AMD Ryzen 9 7950X3D', 'AMD Ryzen 9 9900X', 'AMD Ryzen 9 9950X',
            'AMD Threadripper',
        ],
        'motherboard' => [
            'Intel H610', 'Intel B660', 'Intel B760', 'Intel H770', 'Intel Z690', 'Intel Z790', 'Intel B860', 'Intel Z890',
            'AMD A520', 'AMD B550', 'AMD X570', 'AMD A620', 'AMD B650', 'AMD B650E', 'AMD X670', 'AMD X670E', 'AMD B850', 'AMD X870', 'AMD X870E',
        ],
        'gpu' => [
            'بدون كرت شاشة',
            'NVIDIA GTX 1650', 'NVIDIA RTX 3050', 'NVIDIA RTX 3060', 'NVIDIA RTX 4060', 'NVIDIA RTX 4060 Ti',
            'NVIDIA RTX 4070', 'NVIDIA RTX 4070 Super', 'NVIDIA RTX 4080 Super', 'NVIDIA RTX 4090',
            'NVIDIA RTX 5060', 'NVIDIA RTX 5060 Ti', 'NVIDIA RTX 5070', 'NVIDIA RTX 5070 Ti', 'NVIDIA RTX 5080', 'NVIDIA RTX 5090',
            'AMD RX 6600', 'AMD RX 7600', 'AMD RX 7600 XT', 'AMD RX 7700 XT', 'AMD RX 7800 XT', 'AMD RX 7900 GRE', 'AMD RX 7900 XT', 'AMD RX 7900 XTX',
            'AMD RX 9060 XT', 'AMD RX 9070', 'AMD RX 9070 XT',
        ],
        'ram' => ['16GB DDR4', '32GB DDR4', '64GB DDR4', '16GB DDR5', '32GB DDR5', '64GB DDR5', '128GB DDR5'],
        'storage' => ['بدون', 'SSD SATA 500GB', 'SSD SATA 1TB', 'SSD SATA 2TB', 'NVMe 500GB', 'NVMe 1TB', 'NVMe 2TB', 'NVMe 4TB', 'HDD 1TB', 'HDD 2TB', 'HDD 4TB', 'HDD 8TB'],
        'psu' => [
            '450W Bronze', '500W Bronze', '550W Bronze', '600W Bronze', '650W Bronze', '700W Bronze', '750W Bronze', '850W Bronze',
            '550W Gold', '650W Gold', '750W Gold', '850W Gold', '1000W Gold', '1200W Gold',
            '850W Platinum', '1000W Platinum', '1200W Platinum', '1600W Platinum',
            'Corsair 650W', 'Corsair 750W', 'Corsair 850W', 'Corsair 1000W',
            'Cooler Master 650W', 'Cooler Master 750W', 'Cooler Master 850W',
            'EVGA 650W', 'EVGA 750W', 'EVGA 850W',
            'Seasonic 650W', 'Seasonic 750W', 'Seasonic 850W', 'Seasonic 1000W',
            'Thermaltake 650W', 'Thermaltake 750W', 'Thermaltake 850W',
        ],
        'case' => ['Mid Tower Airflow', 'Compact RGB', 'Full Tower', 'Mini ITX', 'بدون كيس'],
    ],

    // Prices for the PC-build assembly service line (SAR).
    'build_pricing' => [
        'air' => 150,
        'water' => 200,
    ],

    // Default country code used to normalise local (05xxxxxxxx) numbers into
    // international wa.me links. 966 = Saudi Arabia.
    'whatsapp_country_code' => '966',
];
