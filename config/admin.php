<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Mock Data untuk Admin Dashboard
    |--------------------------------------------------------------------------
    |
    | Data statis untuk dashboard admin. Dalam produksi, ini akan diganti
    | dengan data dari database.
    |
    */

    'users' => [
        [
            'id' => 1,
            'name' => 'Andi Pratama',
            'email' => 'andi.pratama@example.com',
            'role' => 'Admin',
            'status' => 'Active',
            'tasks_completed' => 45,
            'joined_date' => '2024-01-15',
            'last_login' => '2025-10-20 08:30:00'
        ],
        [
            'id' => 2,
            'name' => 'Siti Nurhaliza',
            'email' => 'siti.nurhaliza@example.com',
            'role' => 'User',
            'status' => 'Active',
            'tasks_completed' => 32,
            'joined_date' => '2024-02-20',
            'last_login' => '2025-10-19 14:20:00'
        ],
        [
            'id' => 3,
            'name' => 'Budi Santoso',
            'email' => 'budi.santoso@example.com',
            'role' => 'User',
            'status' => 'Inactive',
            'tasks_completed' => 18,
            'joined_date' => '2024-03-10',
            'last_login' => '2025-10-10 10:15:00'
        ],
        [
            'id' => 4,
            'name' => 'Dewi Lestari',
            'email' => 'dewi.lestari@example.com',
            'role' => 'Moderator',
            'status' => 'Active',
            'tasks_completed' => 67,
            'joined_date' => '2024-01-25',
            'last_login' => '2025-10-20 09:45:00'
        ],
        [
            'id' => 5,
            'name' => 'Rudi Hartono',
            'email' => 'rudi.hartono@example.com',
            'role' => 'User',
            'status' => 'Active',
            'tasks_completed' => 23,
            'joined_date' => '2024-04-05',
            'last_login' => '2025-10-19 16:30:00'
        ],
        [
            'id' => 6,
            'name' => 'Maya Sari',
            'email' => 'maya.sari@example.com',
            'role' => 'User',
            'status' => 'Active',
            'tasks_completed' => 41,
            'joined_date' => '2024-02-14',
            'last_login' => '2025-10-20 07:00:00'
        ],
        [
            'id' => 7,
            'name' => 'Ahmad Zaki',
            'email' => 'ahmad.zaki@example.com',
            'role' => 'User',
            'status' => 'Pending',
            'tasks_completed' => 12,
            'joined_date' => '2024-05-18',
            'last_login' => '2025-10-18 11:20:00'
        ],
        [
            'id' => 8,
            'name' => 'Rina Wijaya',
            'email' => 'rina.wijaya@example.com',
            'role' => 'User',
            'status' => 'Active',
            'tasks_completed' => 56,
            'joined_date' => '2024-03-22',
            'last_login' => '2025-10-20 10:15:00'
        ]
    ],

    'contents' => [
        ['id' => 1, 'title' => 'Panduan Memulai NotezQue', 'category' => 'Tutorial', 'status' => 'Published', 'views' => 1245, 'created_at' => '2024-01-10', 'updated_at' => '2024-08-15'],
        ['id' => 2, 'title' => 'Tips Produktivitas Harian', 'category' => 'Blog', 'status' => 'Published', 'views' => 892, 'created_at' => '2024-02-05', 'updated_at' => '2024-09-20'],
        ['id' => 3, 'title' => 'Fitur Kolaborasi Tim', 'category' => 'Tutorial', 'status' => 'Published', 'views' => 2103, 'created_at' => '2024-01-20', 'updated_at' => '2024-10-01'],
        ['id' => 4, 'title' => 'Kebijakan Privasi', 'category' => 'Legal', 'status' => 'Published', 'views' => 567, 'created_at' => '2023-12-15', 'updated_at' => '2024-06-10'],
        ['id' => 5, 'title' => 'FAQ - Pertanyaan Umum', 'category' => 'Support', 'status' => 'Published', 'views' => 3421, 'created_at' => '2024-01-05', 'updated_at' => '2024-10-15'],
        ['id' => 6, 'title' => 'Update Fitur Terbaru Q4 2024', 'category' => 'Announcement', 'status' => 'Draft', 'views' => 0, 'created_at' => '2024-10-18', 'updated_at' => '2024-10-18'],
        ['id' => 7, 'title' => 'Integrasi dengan Tools Populer', 'category' => 'Tutorial', 'status' => 'Published', 'views' => 1567, 'created_at' => '2024-03-12', 'updated_at' => '2024-09-05'],
        ['id' => 8, 'title' => 'Syarat dan Ketentuan', 'category' => 'Legal', 'status' => 'Published', 'views' => 423, 'created_at' => '2023-12-15', 'updated_at' => '2024-06-10']
    ],

    'activities' => [
        ['user' => 'Andi Pratama', 'action' => 'menyelesaikan tugas "Review Proposal"', 'time' => '5 menit yang lalu'],
        ['user' => 'Siti Nurhaliza', 'action' => 'membuat kolaborasi baru', 'time' => '15 menit yang lalu'],
        ['user' => 'Dewi Lestari', 'action' => 'mengomentari tugas "Budget Planning"', 'time' => '1 jam yang lalu'],
        ['user' => 'Rudi Hartono', 'action' => 'bergabung ke workspace', 'time' => '2 jam yang lalu']
    ],

    'statistics' => [
        'total_users' => 1248,
        'active_tasks' => 342,
        'today_activities' => 89,
        'collaborations' => 156,
        'total_tasks' => 5432,
        'completed_tasks' => 4123,
        'active_collaborations' => 234,
        'growth_rate' => 12.5
    ],

    'daily_stats' => [
        ['date' => '2025-10-14', 'users' => 89, 'tasks' => 234, 'collaborations' => 45],
        ['date' => '2025-10-15', 'users' => 95, 'tasks' => 267, 'collaborations' => 52],
        ['date' => '2025-10-16', 'users' => 102, 'tasks' => 289, 'collaborations' => 48],
        ['date' => '2025-10-17', 'users' => 98, 'tasks' => 276, 'collaborations' => 50],
        ['date' => '2025-10-18', 'users' => 110, 'tasks' => 312, 'collaborations' => 61],
        ['date' => '2025-10-19', 'users' => 105, 'tasks' => 298, 'collaborations' => 55],
        ['date' => '2025-10-20', 'users' => 89, 'tasks' => 234, 'collaborations' => 42]
    ],

    'category_stats' => [
        ['category' => 'Pekerjaan', 'tasks' => 456, 'percentage' => 38],
        ['category' => 'Pribadi', 'tasks' => 342, 'percentage' => 28],
        ['category' => 'Belajar', 'tasks' => 234, 'percentage' => 19],
        ['category' => 'Hobi', 'tasks' => 180, 'percentage' => 15]
    ]
];
