#!/bin/bash

while read p; do
  BODY=`sort -R influence-reminders-db.txt | head -n1`
  echo "<h1>$BODY</h1> \
  <p>No longer want to receive these reminders? \
  Click <a href='https://www.sanjitdutta.com/influence/?remove_email=$p'>here</a>." \
  | mail -s "Influence Weekly Reminder" $p
done <participants.txt
