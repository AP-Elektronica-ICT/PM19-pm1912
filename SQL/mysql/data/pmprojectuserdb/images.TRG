TYPE=TRIGGERS
triggers='CREATE DEFINER=`root`@`localhost` TRIGGER `image_into_post` AFTER INSERT ON `images` FOR EACH ROW    INSERT INTO posts \n   (postMessage, \n    postImageID,\n    postOwner)\n    VALUES \n    (\'Nieuwe foto\', \n     new.ImageID,\n     1)'
sql_modes=1342177280
definers='root@localhost'
client_cs_names='utf8mb4'
connection_cl_names='utf8mb4_unicode_ci'
db_cl_names='utf32_bin'
