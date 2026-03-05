# Struktur Database (Berdasarkan SQL)

Sumber kebenaran: `hark8423_ems.sql` (dump phpMyAdmin, 2026-03-05).

Aturan: **dilarang mengubah schema**; Model harus mengikuti struktur ini 1:1.

## Ringkasan tabel

- Total tabel: **37**

### `account_logs`

- Primary key: `id`
- Engine/charset: InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci

| Column | Definition |
|---|---|
| `id` | int(11) NOT NULL |
| `user_id` | int(11) NOT NULL |
| `full_name_before` | varchar(100) DEFAULT NULL |
| `full_name_after` | varchar(100) DEFAULT NULL |
| `position_before` | varchar(100) DEFAULT NULL |
| `position_after` | varchar(100) DEFAULT NULL |
| `pin_changed` | tinyint(1) DEFAULT 0 |
| `created_at` | datetime DEFAULT NULL |

### `ai_test_results`

- Primary key: `id`
- Engine/charset: InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci

| Column | Definition |
|---|---|
| `id` | int(11) NOT NULL |
| `applicant_id` | int(11) NOT NULL |
| `answers_json` | longtext NOT NULL |
| `duration_seconds` | int(11) DEFAULT NULL |
| `score_total` | int(11) DEFAULT NULL |
| `consistency_score` | int(11) DEFAULT NULL |
| `focus_score` | int(11) DEFAULT NULL |
| `honesty_score` | int(11) DEFAULT 0 |
| `attitude_score` | int(11) DEFAULT NULL |
| `loyalty_score` | int(11) DEFAULT NULL |
| `social_score` | int(11) DEFAULT NULL |
| `risk_flags` | text DEFAULT NULL |
| `personality_summary` | text DEFAULT NULL |
| `decision` | enum('recommended','consider','not_recommended') DEFAULT NULL |
| `created_at` | timestamp NULL DEFAULT current_timestamp() |

### `api_tokens`

- Primary key: `id`
- Engine/charset: InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci

| Column | Definition |
|---|---|
| `id` | int(11) NOT NULL |
| `token` | varchar(64) NOT NULL |
| `name` | varchar(100) DEFAULT NULL |
| `is_active` | tinyint(1) DEFAULT 1 |
| `created_at` | timestamp NULL DEFAULT current_timestamp() |
| `client_id` | varchar(50) DEFAULT NULL |

### `app_settings`

- Primary key: `id`
- Engine/charset: InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci

| Column | Definition |
|---|---|
| `id` | bigint(20) UNSIGNED NOT NULL |
| `app_name` | varchar(150) NOT NULL |
| `app_logo_path` | varchar(255) DEFAULT NULL |
| `timezone` | varchar(64) DEFAULT NULL |
| `created_at` | timestamp NULL DEFAULT NULL |
| `updated_at` | timestamp NULL DEFAULT NULL |

### `applicant_documents`

- Primary key: `id`
- Engine/charset: InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci

| Column | Definition |
|---|---|
| `id` | int(11) NOT NULL |
| `applicant_id` | int(11) NOT NULL |
| `document_type` | enum('ktp_ic','skb','sim','lainnya') NOT NULL |
| `file_path` | varchar(255) NOT NULL |
| `is_valid` | tinyint(1) DEFAULT NULL |
| `validation_notes` | text DEFAULT NULL |
| `uploaded_at` | timestamp NULL DEFAULT current_timestamp() |

### `applicant_final_decisions`

- Primary key: `id`
- Engine/charset: InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci

| Column | Definition |
|---|---|
| `id` | int(11) NOT NULL |
| `applicant_id` | int(11) NOT NULL |
| `system_result` | enum('lolos','tidak_lolos') NOT NULL |
| `overridden` | tinyint(1) DEFAULT 0 |
| `override_reason` | text DEFAULT NULL |
| `final_result` | enum('lolos','tidak_lolos') NOT NULL |
| `decided_by` | varchar(100) NOT NULL |
| `decided_at` | timestamp NULL DEFAULT current_timestamp() |

### `applicant_interview_results`

- Primary key: `id`
- Engine/charset: InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci

| Column | Definition |
|---|---|
| `id` | int(11) NOT NULL |
| `applicant_id` | int(11) NOT NULL |
| `total_hr` | int(11) NOT NULL |
| `average_score` | decimal(5,2) NOT NULL |
| `final_grade` | enum('sangat_buruk','buruk','sedang','baik','sangat_baik') NOT NULL |
| `final_notes` | text DEFAULT NULL |
| `hr_notes` | text DEFAULT NULL |
| `ml_flags` | text DEFAULT NULL |
| `ml_confidence` | decimal(5,2) DEFAULT NULL |
| `ml_notes` | text DEFAULT NULL |
| `is_locked` | tinyint(1) DEFAULT 0 |
| `locked_at` | timestamp NULL DEFAULT NULL |
| `calculated_at` | timestamp NULL DEFAULT current_timestamp() |

### `applicant_interview_scores`

- Primary key: `id`
- Engine/charset: InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci

| Column | Definition |
|---|---|
| `id` | int(11) NOT NULL |
| `applicant_id` | int(11) NOT NULL |
| `hr_id` | int(11) NOT NULL |
| `criteria_id` | int(11) NOT NULL |
| `score` | tinyint(4) NOT NULL COMMENT '1-5' |
| `notes` | text DEFAULT NULL |
| `created_at` | timestamp NULL DEFAULT current_timestamp() |

### `consumers`

- Primary key: `id`
- Engine/charset: InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci

| Column | Definition |
|---|---|
| `id` | bigint(20) UNSIGNED NOT NULL |
| `first_name` | varchar(100) NOT NULL |
| `last_name` | varchar(100) NOT NULL |
| `dob` | date NOT NULL COMMENT 'Date of Birth' |
| `sex` | enum('male','female') NOT NULL |
| `nationality` | varchar(100) NOT NULL DEFAULT 'Indonesia' |
| `citizen_id` | varchar(50) NOT NULL COMMENT 'Nomor Identitas / Citizen ID' |
| `pekerjaan` | varchar(100) NOT NULL DEFAULT 'Freelance' |
| `registered_by` | varchar(100) NOT NULL |
| `registered_by_user_id` | int(11) NOT NULL |
| `created_at` | timestamp NULL DEFAULT current_timestamp() |
| `updated_at` | timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() |

### `ems_sales`

- Primary key: `id`
- Engine/charset: InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci

| Column | Definition |
|---|---|
| `id` | int(11) NOT NULL |
| `service_type` | varchar(50) NOT NULL |
| `service_detail` | varchar(100) NOT NULL |
| `operasi_tingkat` | varchar(10) DEFAULT NULL |
| `medicine_usage` | text DEFAULT NULL |
| `patient_name` | varchar(100) DEFAULT NULL |
| `location` | varchar(10) DEFAULT NULL |
| `qty` | int(11) DEFAULT 1 |
| `price` | int(11) NOT NULL DEFAULT 0 |
| `total` | int(11) NOT NULL DEFAULT 0 |
| `payment_type` | varchar(20) DEFAULT NULL |
| `medic_name` | varchar(100) NOT NULL |
| `medic_jabatan` | varchar(100) NOT NULL |
| `created_at` | datetime NOT NULL DEFAULT current_timestamp() |
| `billing_amount` | int(11) DEFAULT 0 |
| `cash_amount` | int(11) DEFAULT 0 |
| `doctor_share` | int(11) DEFAULT 0 |
| `team_share` | int(11) DEFAULT 0 |

### `event_group_members`

- Primary key: `id`
- Engine/charset: InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci

| Column | Definition |
|---|---|
| `id` | int(11) NOT NULL |
| `event_group_id` | int(11) NOT NULL |
| `user_id` | int(11) NOT NULL |

### `event_groups`

- Primary key: `id`
- Engine/charset: InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci

| Column | Definition |
|---|---|
| `id` | int(11) NOT NULL |
| `event_id` | int(11) NOT NULL |
| `group_name` | varchar(50) NOT NULL |
| `locked` | tinyint(1) DEFAULT 1 |
| `created_at` | datetime DEFAULT current_timestamp() |

### `event_participants`

- Primary key: `id`
- Engine/charset: InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci

| Column | Definition |
|---|---|
| `id` | int(11) NOT NULL |
| `event_id` | int(11) NOT NULL |
| `user_id` | int(11) NOT NULL |
| `registered_at` | timestamp NULL DEFAULT current_timestamp() |

### `events`

- Primary key: `id`
- Engine/charset: InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci

| Column | Definition |
|---|---|
| `id` | int(11) NOT NULL |
| `nama_event` | varchar(150) NOT NULL |
| `tanggal_event` | date NOT NULL |
| `lokasi` | varchar(150) DEFAULT NULL |
| `keterangan` | text DEFAULT NULL |
| `is_active` | tinyint(1) DEFAULT 1 |
| `created_at` | timestamp NULL DEFAULT current_timestamp() |

### `farmasi_activities`

- Primary key: `id`
- Engine/charset: InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci

| Column | Definition |
|---|---|
| `id` | bigint(20) UNSIGNED NOT NULL |
| `activity_type` | varchar(50) NOT NULL |
| `medic_user_id` | int(10) UNSIGNED DEFAULT NULL |
| `medic_name` | varchar(255) NOT NULL |
| `description` | text NOT NULL |
| `created_at` | timestamp NULL DEFAULT current_timestamp() |

### `identity_master`

- Primary key: `id`
- Engine/charset: InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci

| Column | Definition |
|---|---|
| `id` | bigint(20) UNSIGNED NOT NULL |
| `citizen_id` | varchar(32) NOT NULL |
| `first_name` | varchar(100) NOT NULL |
| `last_name` | varchar(100) NOT NULL |
| `dob` | date DEFAULT NULL |
| `sex` | enum('M','F') DEFAULT NULL |
| `nationality` | varchar(50) DEFAULT NULL |
| `image_path` | varchar(255) DEFAULT NULL |
| `created_at` | datetime NOT NULL DEFAULT current_timestamp() |
| `updated_at` | datetime DEFAULT NULL ON UPDATE current_timestamp() |
| `active_version_id` | bigint(20) UNSIGNED DEFAULT NULL |

### `identity_versions`

- Primary key: `id`
- Engine/charset: InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci

| Column | Definition |
|---|---|
| `id` | bigint(20) UNSIGNED NOT NULL |
| `identity_id` | bigint(20) UNSIGNED NOT NULL |
| `citizen_id` | varchar(32) NOT NULL |
| `first_name` | varchar(100) NOT NULL |
| `last_name` | varchar(100) NOT NULL |
| `dob` | date DEFAULT NULL |
| `sex` | enum('M','F') DEFAULT NULL |
| `nationality` | varchar(50) DEFAULT NULL |
| `image_path` | varchar(255) DEFAULT NULL |
| `change_reason` | text DEFAULT NULL |
| `changed_by` | bigint(20) UNSIGNED DEFAULT NULL |
| `created_at` | datetime NOT NULL DEFAULT current_timestamp() |

### `interview_criteria`

- Primary key: `id`
- Engine/charset: InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci

| Column | Definition |
|---|---|
| `id` | int(11) NOT NULL |
| `code` | varchar(50) NOT NULL |
| `label` | varchar(100) NOT NULL |
| `description` | text DEFAULT NULL |
| `weight` | int(11) DEFAULT 1 |
| `is_active` | tinyint(1) DEFAULT 1 |

### `medic_operasi_plastik`

- Primary key: `id`
- Engine/charset: InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci

| Column | Definition |
|---|---|
| `id` | int(11) NOT NULL |
| `id_user` | int(11) NOT NULL |
| `tanggal` | date NOT NULL |
| `jenis_operasi` | enum('Rekonstruksi Wajah','Suntik Putih') NOT NULL |
| `alasan` | text NOT NULL |
| `status` | enum('pending','approved','rejected') NOT NULL DEFAULT 'pending' |
| `approved_by` | int(11) DEFAULT NULL |
| `approved_at` | datetime DEFAULT NULL |
| `id_penanggung_jawab` | int(11) NOT NULL |
| `created_at` | timestamp NULL DEFAULT current_timestamp() |

### `medical_applicants`

- Primary key: `id`
- Engine/charset: InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci

| Column | Definition |
|---|---|
| `id` | int(11) NOT NULL |
| `ic_name` | varchar(150) NOT NULL |
| `ooc_age` | int(11) NOT NULL |
| `ic_phone` | varchar(30) NOT NULL |
| `medical_experience` | text DEFAULT NULL |
| `city_duration` | varchar(100) DEFAULT NULL |
| `online_schedule` | varchar(150) DEFAULT NULL |
| `other_city_responsibility` | text DEFAULT NULL |
| `motivation` | text DEFAULT NULL |
| `work_principle` | text DEFAULT NULL |
| `academy_ready` | enum('ya','tidak') NOT NULL |
| `academy_reason` | text DEFAULT NULL |
| `rule_commitment` | enum('ya','tidak') NOT NULL |
| `duty_duration` | varchar(150) DEFAULT NULL |
| `status` | enum('submitted','ai_test','ai_completed','interview','final_review','accepted','rejected') DEFAULT 'submitted' |
| `rejection_stage` | enum('ai','interview') DEFAULT NULL |
| `created_at` | timestamp NULL DEFAULT current_timestamp() |

### `medical_regulations`

- Primary key: `id`
- Engine/charset: InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci

| Column | Definition |
|---|---|
| `id` | int(11) NOT NULL |
| `category` | varchar(50) NOT NULL |
| `code` | varchar(50) NOT NULL |
| `name` | varchar(100) NOT NULL |
| `location` | varchar(50) DEFAULT NULL |
| `price_type` | enum('FIXED','RANGE') NOT NULL |
| `price_min` | int(11) NOT NULL DEFAULT 0 |
| `price_max` | int(11) NOT NULL DEFAULT 0 |
| `payment_type` | enum('CASH','INVOICE','BILLING') NOT NULL |
| `duration_minutes` | int(11) DEFAULT NULL |
| `notes` | text DEFAULT NULL |
| `is_active` | tinyint(1) DEFAULT 1 |
| `created_at` | timestamp NULL DEFAULT current_timestamp() |

### `packages`

- Primary key: `id`
- Engine/charset: InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci

| Column | Definition |
|---|---|
| `id` | int(11) NOT NULL |
| `name` | varchar(100) NOT NULL |
| `bandage_qty` | int(11) NOT NULL DEFAULT 0 |
| `ifaks_qty` | int(11) NOT NULL DEFAULT 0 |
| `painkiller_qty` | int(11) NOT NULL DEFAULT 0 |
| `price` | int(11) NOT NULL |

### `reimbursements`

- Primary key: `id`
- Engine/charset: InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci

| Column | Definition |
|---|---|
| `id` | bigint(20) UNSIGNED NOT NULL |
| `reimbursement_code` | varchar(50) NOT NULL COMMENT '1 kode bisa banyak item' |
| `billing_source_type` | enum('instansi','restoran','toko','vendor','lainnya') NOT NULL |
| `billing_source_name` | varchar(255) NOT NULL |
| `item_name` | varchar(255) NOT NULL |
| `description` | text DEFAULT NULL |
| `qty` | int(11) DEFAULT 1 |
| `price` | decimal(15,2) DEFAULT 0.00 |
| `amount` | decimal(15,2) NOT NULL |
| `receipt_file` | varchar(255) DEFAULT NULL |
| `status` | enum('draft','submitted','paid','rejected') DEFAULT 'draft' |
| `created_by` | bigint(20) UNSIGNED NOT NULL COMMENT 'User pengaju' |
| `paid_by` | bigint(20) UNSIGNED DEFAULT NULL COMMENT 'User yang membayarkan (manager)' |
| `submitted_at` | datetime DEFAULT NULL |
| `paid_at` | datetime DEFAULT NULL |
| `payment_note` | text DEFAULT NULL |
| `created_at` | timestamp NULL DEFAULT current_timestamp() |
| `updated_at` | timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() |

### `remember_tokens`

- Primary key: `id`
- Engine/charset: InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci

| Column | Definition |
|---|---|
| `id` | int(11) NOT NULL |
| `user_id` | int(11) NOT NULL |
| `token_hash` | varchar(255) NOT NULL |
| `expired_at` | datetime NOT NULL |
| `created_at` | datetime DEFAULT current_timestamp() |

### `restaurant_consumptions`

- Primary key: `id`
- Engine/charset: InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci

| Column | Definition |
|---|---|
| `id` | int(11) NOT NULL |
| `consumption_code` | varchar(50) NOT NULL |
| `restaurant_id` | int(11) NOT NULL |
| `restaurant_name` | varchar(255) NOT NULL |
| `recipient_user_id` | int(11) NOT NULL COMMENT 'User yang login/menginput' |
| `recipient_name` | varchar(255) NOT NULL COMMENT 'Nama user yang menerima konsumsi' |
| `delivery_date` | date NOT NULL |
| `delivery_time` | time NOT NULL |
| `packet_count` | int(11) NOT NULL DEFAULT 0 |
| `price_per_packet` | decimal(10,2) NOT NULL DEFAULT 0.00 |
| `tax_percentage` | decimal(5,2) NOT NULL DEFAULT 5.00 |
| `subtotal` | decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT 'packet_count * price_per_packet' |
| `tax_amount` | decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT 'subtotal * tax_percentage / 100' |
| `total_amount` | decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT 'subtotal + tax_amount' |
| `ktp_file` | varchar(500) DEFAULT NULL COMMENT 'Foto KTP karyawan restoran' |
| `notes` | text DEFAULT NULL |
| `status` | enum('pending','approved','paid','cancelled') NOT NULL DEFAULT 'pending' |
| `created_at` | timestamp NOT NULL DEFAULT current_timestamp() |
| `updated_at` | timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() |
| `created_by` | int(11) NOT NULL |
| `approved_by` | int(11) DEFAULT NULL |
| `approved_at` | timestamp NULL DEFAULT NULL |
| `paid_by` | int(11) DEFAULT NULL |
| `paid_at` | timestamp NULL DEFAULT NULL |

### `restaurant_settings`

- Primary key: `id`
- Engine/charset: InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci

| Column | Definition |
|---|---|
| `id` | int(11) NOT NULL |
| `restaurant_name` | varchar(255) NOT NULL |
| `price_per_packet` | decimal(10,2) NOT NULL DEFAULT 0.00 |
| `tax_percentage` | decimal(5,2) NOT NULL DEFAULT 5.00 |
| `is_active` | tinyint(1) NOT NULL DEFAULT 1 |
| `created_at` | timestamp NOT NULL DEFAULT current_timestamp() |
| `updated_at` | timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() |

### `salary`

- Primary key: `id`
- Engine/charset: InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci

| Column | Definition |
|---|---|
| `id` | int(11) NOT NULL |
| `medic_name` | varchar(100) NOT NULL |
| `medic_jabatan` | varchar(100) DEFAULT NULL |
| `period_start` | date NOT NULL |
| `period_end` | date NOT NULL |
| `total_transaksi` | int(11) NOT NULL DEFAULT 0 |
| `total_item` | int(11) NOT NULL DEFAULT 0 |
| `total_rupiah` | int(11) NOT NULL DEFAULT 0 |
| `bonus_40` | int(11) NOT NULL DEFAULT 0 |
| `status` | enum('pending','paid') NOT NULL DEFAULT 'pending' |
| `paid_at` | datetime DEFAULT NULL |
| `paid_by` | varchar(100) DEFAULT NULL |
| `created_at` | datetime DEFAULT current_timestamp() |

### `sales`

- Primary key: `id`
- Engine/charset: InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci

| Column | Definition |
|---|---|
| `id` | int(11) NOT NULL |
| `consumer_name` | varchar(100) NOT NULL |
| `consumer_id` | bigint(20) UNSIGNED DEFAULT NULL |
| `medic_name` | varchar(100) NOT NULL |
| `medic_user_id` | int(11) DEFAULT NULL |
| `medic_jabatan` | varchar(50) NOT NULL |
| `package_id` | int(11) NOT NULL |
| `package_name` | varchar(100) NOT NULL |
| `price` | int(11) NOT NULL |
| `qty_bandage` | int(11) NOT NULL DEFAULT 0 |
| `qty_ifaks` | int(11) NOT NULL DEFAULT 0 |
| `qty_painkiller` | int(11) NOT NULL DEFAULT 0 |
| `keterangan` | text DEFAULT NULL |
| `created_at` | datetime NOT NULL DEFAULT current_timestamp() |
| `tx_hash` | char(64) NOT NULL |
| `identity_id` | int(11) DEFAULT NULL |
| `synced_to_sheet` | tinyint(1) NOT NULL DEFAULT 0 |

### `sessions`

- Primary key: `id`
- Engine/charset: InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci

| Column | Definition |
|---|---|
| `id` | varchar(255) NOT NULL |
| `user_id` | bigint(20) UNSIGNED DEFAULT NULL |
| `ip_address` | varchar(45) DEFAULT NULL |
| `user_agent` | text DEFAULT NULL |
| `payload` | longtext NOT NULL |
| `last_activity` | int(11) NOT NULL |

### `user_farmasi_force_logs`

- Primary key: `id`
- Engine/charset: InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci

| Column | Definition |
|---|---|
| `id` | int(11) NOT NULL |
| `target_user_id` | int(11) NOT NULL |
| `forced_by_user_id` | int(11) NOT NULL |
| `reason` | text NOT NULL |
| `forced_at` | datetime NOT NULL |
| `created_at` | datetime DEFAULT current_timestamp() |

### `user_farmasi_notifications`

- Primary key: `id`
- Engine/charset: InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci

| Column | Definition |
|---|---|
| `id` | int(11) NOT NULL |
| `user_id` | int(11) NOT NULL |
| `type` | varchar(50) NOT NULL |
| `message` | varchar(255) NOT NULL |
| `is_read` | tinyint(1) NOT NULL DEFAULT 0 |
| `created_at` | datetime NOT NULL DEFAULT current_timestamp() |

### `user_farmasi_sessions`

- Primary key: `id`
- Engine/charset: InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci

| Column | Definition |
|---|---|
| `id` | int(11) NOT NULL |
| `user_id` | int(11) NOT NULL |
| `medic_name` | varchar(100) NOT NULL |
| `medic_jabatan` | varchar(100) DEFAULT NULL |
| `session_start` | datetime NOT NULL |
| `session_end` | datetime DEFAULT NULL |
| `duration_seconds` | int(11) DEFAULT NULL COMMENT 'Durasi sesi dalam detik' |
| `end_reason` | enum('manual_offline','auto_offline','force_offline','system') DEFAULT NULL |
| `ended_by_user_id` | int(11) DEFAULT NULL COMMENT 'Jika force / manual oleh orang lain' |
| `created_at` | datetime DEFAULT current_timestamp() |
| `updated_at` | datetime DEFAULT current_timestamp() ON UPDATE current_timestamp() |

### `user_farmasi_status`

- Primary key: `user_id`
- Engine/charset: InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci

| Column | Definition |
|---|---|
| `user_id` | int(11) NOT NULL |
| `status` | enum('online','offline') NOT NULL DEFAULT 'offline' |
| `last_activity_at` | datetime NOT NULL |
| `last_confirm_at` | datetime DEFAULT NULL |
| `auto_offline_at` | datetime DEFAULT NULL |
| `created_at` | datetime DEFAULT current_timestamp() |
| `updated_at` | datetime DEFAULT current_timestamp() ON UPDATE current_timestamp() |

### `user_inbox`

- Primary key: `id`
- Engine/charset: InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci

| Column | Definition |
|---|---|
| `id` | int(11) NOT NULL |
| `user_id` | int(11) NOT NULL |
| `title` | varchar(150) NOT NULL |
| `message` | mediumtext NOT NULL |
| `type` | varchar(50) DEFAULT NULL |
| `is_read` | tinyint(1) DEFAULT 0 |
| `created_at` | datetime DEFAULT current_timestamp() |

### `user_push_subscriptions`

- Primary key: `id`
- Engine/charset: InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci

| Column | Definition |
|---|---|
| `id` | int(11) NOT NULL |
| `user_id` | int(11) NOT NULL |
| `endpoint` | varchar(512) NOT NULL |
| `p256dh` | text NOT NULL |
| `auth` | text NOT NULL |
| `created_at` | datetime DEFAULT current_timestamp() |
| `updated_at` | datetime DEFAULT NULL |

### `user_rh`

- Primary key: `id`
- Engine/charset: InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci

| Column | Definition |
|---|---|
| `id` | int(11) NOT NULL |
| `full_name` | varchar(100) NOT NULL |
| `citizen_id` | varchar(30) DEFAULT NULL |
| `no_hp_ic` | varchar(20) DEFAULT NULL |
| `jenis_kelamin` | enum('Laki-laki','Perempuan') DEFAULT NULL |
| `pin` | varchar(255) NOT NULL |
| `api_token` | varchar(64) DEFAULT NULL |
| `role` | enum('Staff','Staff Manager','Manager','Vice Director','Director') NOT NULL DEFAULT 'Staff' |
| `batch` | int(11) DEFAULT NULL |
| `kode_nomor_induk_rs` | varchar(30) DEFAULT NULL |
| `position` | varchar(100) DEFAULT NULL |
| `tanggal_masuk` | date DEFAULT NULL |
| `file_ktp` | varchar(255) DEFAULT NULL |
| `file_sim` | varchar(255) DEFAULT NULL |
| `file_kta` | varchar(255) DEFAULT NULL |
| `file_skb` | varchar(255) DEFAULT NULL |
| `sertifikat_heli` | varchar(255) DEFAULT NULL |
| `sertifikat_operasi` | varchar(255) DEFAULT NULL |
| `dokumen_lainnya` | varchar(255) DEFAULT NULL |
| `is_verified` | tinyint(1) NOT NULL DEFAULT 0 |
| `created_at` | datetime DEFAULT current_timestamp() |
| `updated_at` | datetime DEFAULT current_timestamp() ON UPDATE current_timestamp() |
| `is_active` | tinyint(1) NOT NULL DEFAULT 1 |
| `resign_reason` | text DEFAULT NULL |
| `resigned_by` | int(11) DEFAULT NULL |
| `resigned_at` | datetime DEFAULT NULL |
| `reactivated_at` | datetime DEFAULT NULL |
| `reactivated_by` | int(11) DEFAULT NULL |
| `reactivated_note` | text DEFAULT NULL |

### `user_spreadsheets`

- Primary key: `id`
- Engine/charset: InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci

| Column | Definition |
|---|---|
| `id` | int(11) NOT NULL |
| `medic_user_id` | int(11) NOT NULL |
| `spreadsheet_id` | varchar(100) NOT NULL |
| `spreadsheet_url` | text NOT NULL |
| `created_at` | datetime DEFAULT current_timestamp() |

