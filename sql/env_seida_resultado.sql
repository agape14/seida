CREATE TABLE `env_seida_resultado` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `oi_bill_of_ladings_id` int(10) unsigned NOT NULL,
  `hbl_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion2` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `env_seida_resultado_oi_bill_of_ladings_id_foreign` (`oi_bill_of_ladings_id`) USING BTREE,
  CONSTRAINT `env_seida_resultado_oi_bill_of_ladings_id_foreign` FOREIGN KEY (`oi_bill_of_ladings_id`) REFERENCES `oi_bill_of_ladings` (`id`)
  
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;