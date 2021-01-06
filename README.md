# Interplanets date system converter

Imagine one day we colonize new planets and you want to know if it's Valentine day at that planet so you don't forget to call your alien girlfriend/boyfriend, here come this tool in handy to convert between date systems. 

This is a console application proudly powered the 💪 Lumen.

## Screenshot

![Screenshot](screenshot.gif)

## Calendars

  - Gregorian Calendar.
  - Equally distributed days, means the month lengh is the same through the year.

  This tool has been made so adding new calendar systems is easy.

## How to

  - of course the `composer install`
  - copy .env.example into .env and configure your database
  - `php artisan migrate`

## Commands

  - `php artisan planets:add` to add a new planet
  - `php artisan planets:list` to list all planets
  - `php artisan planets:get ID` to get a specific planet ID
  - `php artisan planets:delete ID` to delete a specific planet ID
  - `php artisan planets:add ID AMOUNT --unit=UNIT` add AMOUNT of UNIT to the specifi planet ID. Unit can be : 
    - `days`
    - `months`
    - `years`
    - `date` with the format 'YYY-MM-DD'
  - `phpunit` to run the tests


## todos and ideas

  - Add time handeling!
  - Add more calendars
  - Add Notification (about the valentine thing :p)

## Contributions

Either you found a bug, or want something implemented, go ahead and hack your way into the code, PRs are welcome.

License
----

MIT
