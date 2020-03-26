--
-- Base Table
--
CREATE TABLE `fingerprint` (
  `Fingerprint_ID` int(11) NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `fingerprint`
  ADD PRIMARY KEY (`Fingerprint_ID`);

ALTER TABLE `fingerprint`
  MODIFY `Fingerprint_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Permissions
--
INSERT INTO `permission` (`permission_key`, `module`, `label`, `nav_label`, `nav_href`, `show_in_menu`) VALUES
('add', 'OnePlace\\Fingerprint\\Controller\\FingerprintController', 'Add', '', '', 0),
('edit', 'OnePlace\\Fingerprint\\Controller\\FingerprintController', 'Edit', '', '', 0),
('index', 'OnePlace\\Fingerprint\\Controller\\FingerprintController', 'Index', 'Fingerprints', '/fingerprint', 1),
('list', 'OnePlace\\Fingerprint\\Controller\\ApiController', 'List', '', '', 1),
('view', 'OnePlace\\Fingerprint\\Controller\\FingerprintController', 'View', '', '', 0),
('dump', 'OnePlace\\Fingerprint\\Controller\\ExportController', 'Excel Dump', '', '', 0),
('index', 'OnePlace\\Fingerprint\\Controller\\SearchController', 'Search', '', '', 0);

--
-- Form
--
INSERT INTO `core_form` (`form_key`, `label`, `entity_class`, `entity_tbl_class`) VALUES
('fingerprint-single', 'Fingerprint', 'OnePlace\\Fingerprint\\Model\\Fingerprint', 'OnePlace\\Fingerprint\\Model\\FingerprintTable');

--
-- Index List
--
INSERT INTO `core_index_table` (`table_name`, `form`, `label`) VALUES
('fingerprint-index', 'fingerprint-single', 'Fingerprint Index');

--
-- Tabs
--
INSERT INTO `core_form_tab` (`Tab_ID`, `form`, `title`, `subtitle`, `icon`, `counter`, `sort_id`, `filter_check`, `filter_value`) VALUES ('fingerprint-base', 'fingerprint-single', 'Fingerprint', 'Base', 'fas fa-cogs', '', '0', '', '');

--
-- Buttons
--
INSERT INTO `core_form_button` (`Button_ID`, `label`, `icon`, `title`, `href`, `class`, `append`, `form`, `mode`, `filter_check`, `filter_value`) VALUES
(NULL, 'Save Fingerprint', 'fas fa-save', 'Save Fingerprint', '#', 'primary saveForm', '', 'fingerprint-single', 'link', '', ''),
(NULL, 'Edit Fingerprint', 'fas fa-edit', 'Edit Fingerprint', '/fingerprint/edit/##ID##', 'primary', '', 'fingerprint-view', 'link', '', ''),
(NULL, 'Add Fingerprint', 'fas fa-plus', 'Add Fingerprint', '/fingerprint/add', 'primary', '', 'fingerprint-index', 'link', '', ''),
(NULL, 'Export Fingerprints', 'fas fa-file-excel', 'Export Fingerprints', '/fingerprint/export', 'primary', '', 'fingerprint-index', 'link', '', ''),
(NULL, 'Find Fingerprints', 'fas fa-searh', 'Find Fingerprints', '/fingerprint/search', 'primary', '', 'fingerprint-index', 'link', '', ''),
(NULL, 'Export Fingerprints', 'fas fa-file-excel', 'Export Fingerprints', '#', 'primary initExcelDump', '', 'fingerprint-search', 'link', '', ''),
(NULL, 'New Search', 'fas fa-searh', 'New Search', '/fingerprint/search', 'primary', '', 'fingerprint-search', 'link', '', '');

--
-- Fields
--
INSERT INTO `core_form_field` (`Field_ID`, `type`, `label`, `fieldkey`, `tab`, `form`, `class`, `url_view`, `url_list`, `show_widget_left`, `allow_clear`, `readonly`, `tbl_cached_name`, `tbl_class`, `tbl_permission`) VALUES
(NULL, 'text', 'Name', 'label', 'fingerprint-base', 'fingerprint-single', 'col-md-3', '/fingerprint/view/##ID##', '', 0, 1, 0, '', '', '');

--
-- User XP Activity
--
INSERT INTO `user_xp_activity` (`Activity_ID`, `xp_key`, `label`, `xp_base`) VALUES
(NULL, 'fingerprint-add', 'Add New Fingerprint', '50'),
(NULL, 'fingerprint-edit', 'Edit Fingerprint', '5'),
(NULL, 'fingerprint-export', 'Edit Fingerprint', '5');

COMMIT;