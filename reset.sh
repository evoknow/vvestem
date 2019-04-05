#!/bin/bash

echo "Are you sure you want to reset all stats?"
echo "Press ctrl+c to stop now or in 10 seconds, the stats will be reset"
sleep 1

TMP=/var/tmp

if [ -e $TMP/puzzle.json ]; then

    echo "Found $TMP/puzzle.json ... deleting it";
    /bin/rm -f $TMP/puzzle.json;

fi

if [ -e $TMP/solution*.html ]; then

   echo "Found solutions files ... deleting them";
   /bin/rm -f $TMP/solution*.html;
 
fi

ls -l $TMP;
