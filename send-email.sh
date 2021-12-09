#!/bin/bash

FILE="./influence-reminders.json"
LENGTH=`jq length $FILE`

while read p; do
  ENTRY=$[RANDOM % LENGTH]
  SUBJECT=`jq -r ".[${ENTRY}].title" $FILE`
  DESCRIPTION=`jq -r ".[${ENTRY}].body" $FILE`
  echo "<h1>$SUBJECT</h1> \
  <p>$DESCRIPTION</p><br /> \
  <p>No longer want to receive these reminders? \
  Click <a href='https://www.sanjitdutta.com/influence/?remove_email=$p'>here</a>." \
  | mail -s "Influence Weekly Reminder: $SUBJECT" $p
done <participants.txt
