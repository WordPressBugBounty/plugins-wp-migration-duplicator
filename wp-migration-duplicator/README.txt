=== WebToffee WP Backup and Migration ===
Contributors: webtoffee
Donate link: https://www.webtoffee.com/plugins
Tags:  wordpress migration, backup and restore wordpress, wordpress backup, database restore, cloud backup
Requires at least: 3.3
Tested up to: 6.8
Requires PHP: 5.6
Stable tag: 1.5.7
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Easily backup, restore, or migrate. Supports one-click backup and scheduled backup. Backup selected content to Amazon S3, Google Drive, FTP/SFTP, etc.

== Description ==

= Simple, Easy-to-use WordPress Migration Plugin =

This WordPress migrator plugin lets you migrate your WordPress site between any hosts or domains. You can backup your WordPress site automatically or manually on a single click and restore it to the target site with zero downtime.

You can backup to cloud (Amazon S3, Google Drive) and external storage locations FTP, SFTP. Other than full site backups, the plugin supports database backups, and lets you migrate only the selected files.

= WebToffee WP Backup and Migration Plugin - features =

&#128312;  <strong>Ease of use:</strong> Migrate all your Wordpress data (media files, plugins, themes, and database) with minimal clicks.
&#128312;  <strong>One-click backup and restore:</strong> Supports single-click backup and restore.
&#128312;<strong> No data size limit for migration:</strong> Backup and restore WordPress site's of any size effortlessly.
&#128312; <strong>Supports all hosts or operating system:</strong> There is no limitation on host and operating system for migration.
&#128312;  <strong>Automated scheduled backups:</strong> Schedule backups on a daily/weekly/monthly basis.
&#128312; <strong>Auto-replace website URLs:</strong> Supports auto-replace of URLs during restore. No longer need for search and replace!
&#128312;  <strong>Multiple backup locations:</strong> Supports FTP/SFTP, Google Drive, Amazon S3, and local storage.
&#128312;  <strong>Backup and migrate only selected data:</strong> You can choose what you need to migrate from your WordPress site. Supports database backup, backup of chosen files (plugins, themes, core files, uploads, etc.)
&#128312; <strong>Supports both MySQL and MySQLi</strong>

= Setup Guide - WordPress Migration & Backup =

You can checkout the <a rel="nofollow" href="https://www.webtoffee.com/wordpress-backup-migration-user-guide/">user guide</a> to easily setup the plugin or watch the below video.

[youtube https://www.youtube.com/watch?v=hIaM_xeWa_8]

= DIFFERENT WORDPRESS MIGRATION CASES THAT CAN BE HANDLED WITH THE PLUGIN =

Following are some of the common use cases you can handle using this plugin.

* Move WordPress site to a new domain
* Transfer your WordPress site from your current host to a new one
* Copy your WordPress site from one domain to another
* Move WordPress from localhost to server
* Move your WordPress site from its subdomain to its root domain
* You need a WordPress clone of the live site for testing or development purposes
* You are creating a manual backup of a WordPress website
* You need to restore WordPress after the site crashed
* You need to do a WordPress restore to an earlier version

= HOW WORDPRESS BACKUP AND MIGRATOR PLUGIN WORKS =

Migrating a WordPress site to anew domain or host consists of three parts – moving the files, moving the database, and reconfiguring (if needed). Our WordPress migration plugin automates this process.

You may follow the below steps for a WordPress full migration.

* Install the WebToffee WP Backup and Migration plugin on your existing website.
* Generate(export) a migration file that includes all the files required as a zip file.
* Install WebToffee WP Backup and Migration plugin on the target site.
* Import the zip file into your new location. The plugin will move all files including    theme files, plugin files, and replace the database.
* You will be logged out forcefully once the WP migration and restore is completed.


== Installation ==

WebToffee WP Backup and Migration can be installed directly through your WordPress Plugins dashboard.

1. Click "Add New" and search for "WebToffee WP Backup and Migration"
2. Install and Activate

WebToffee WP Backup and Migration also can be installed by manually uploading the zip file of the plugin via FTP.

1. Download the zip file of the plugin from the WordPress plugin repository
2. Unzip the downloaded zip file
3. Upload the plugin folder into the 'wp-content/plugins/' directory of your WordPress site
4. Go the ‘Installed Plugins’ page on the WordPress dashboard. Activate WebToffee WP Backup and Migration from the Plugins page

After the installation and activation of the plugin, the plugin menu will appear on the WordPress sidebar.

== Frequently Asked Questions ==

= Does the plugin support multisite? =

The plugin is capable of exporting and importing WordPress multisite.

= How to increase maximum upload file size while migrating with the plugin? =

[You can refer to this article]( https://www.webtoffee.com/increase-maximum-upload-file-size-in-wordpress-migrator/) for learning how to increase the maximum file upload size during migration.

= Does the plugin support all sizes of sites for migration? =

Yes. With the WordPress Backup and Migration plugin you can backup and migrate WordPress sites of all sizes.

= Does it work with all hosts? =

Yes. You can migrate your WordPress site between any hosts with the plugin.


== Screenshots ==

1. WordPress backup and schedule
2. Create a WordPress backup
3. WordPress backup in progress
4. Scheduled WordPress backup
5. Choose a backup location
6. Select the content for backup
7. Restore WordPress site
8. List of recent WordPress site backup files
9. Authenticate FTP/SFTP for backup
10. Authenticate Google drive for backup
11. Authenticate Amazon S3 for backup
12. WordPress backup logs
13. Advanced options for backup
14. Advanced options for restore

== Changelog ==

= 1.5.7  2025-09-16 =
* Google Drive backup(Requires PHP > 8)


[See changelog for all versions](https://plugins.svn.wordpress.org/wp-migration-duplicator/trunk/changelog.txt)

== Upgrade notice ==

= 1.5.7 =
* Google Drive backup(Requires PHP > 8)