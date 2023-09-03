IntegraMOD3
===========
Thank you to Michaelo (Michael O'Toole) of integramod.com and phpbbireland.com for his tireless work building our portal, many mods and helping create the original install procedure.
A huge thank you to Dion of Dion Designs for his work with phpBB3.0.x. After updating the code to run on php7.X I found his code while researching a solution to abbc3. 
His fixes were more thorough than mine and made the core compatible with php8.x so I abandoned many of my updates and implemented his. You'll find links to his site in the 'Mods Database' link in the footer as well as credits for most of the mods.
Without Mike, there would be no IM3. Without Dion I would have simply updated integramod.com and called it a day.

Currently most file edits are done. Now is the daunting task of adding all db edits to develop/create_schema_files.php to create the db files for all supported db types. This will take awhile. 
If your a dev and want to test or contrubute, there is a snapshot mysql4/mysqli db in __install/test_db
just edit backup.sql phpbb_config with your domain information and insert it into your db. Also edit root/config.php with your db info.
login to your site with:
username= IM_Admin
password= AdminPassword
dont forget to change these after install as they are insecure
any feedback is welcome at https://integramod.com/forum/
Please do not use this for a live site as it is still beta
