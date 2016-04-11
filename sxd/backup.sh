#!/bin/bash
#
# fullsitebackup.sh V1.0
#
# Full backup of website files and database content.
#
# A number of variables defining file location and database connection
# information must be set before this script will run.
# Files are tar'ed from the root directory of the website. All files are
# saved. The MySQL database tables are dumped without a database name and
# and with the option to drop and recreate the tables.
#
# Parameters:
#    tar_file_name (optional)

#
# Configuration
#



# Website Files
  webrootdir=$(pwd) 


#
# Variables
#

# Default TAR Output File Base Name
  tarnamebase=sitebackup-
  datestamp=`date +'%Y-%m-%d'`






#
# Input Parameter Check
#

if test "$1" = ""
  then
    tarname=$tarnamebase$datestamp
  else
    tarname=$1
fi


#
# Banner
#
echo ""
echo "Cooly Backup V1.0"




#
# TAR website files
#
echo "Backing up website files in $webrootdir"
cd $webrootdir/sxd/backup/web
time_start=`date +%s`
tar cvzf $tarname.tar.gz $webrootdir --exclude sxd *
time_end=`date +%s`
time_elapsed=$((time_end - time_start))
echo "    done"





#
# Exit banner
#
echo " .. Full site backup complete in " $(( time_elapsed / 60 ))m $(( time_elapsed % 60 ))s



