<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

<style>
    .button {
        margin: 40%;
    }
</style>

<?php
/* 
anchor address:
http://www.google.com/calendar/event?
This is the base of the address before the parameters below.


action:
    action=TEMPLATE
    A default required parameter.

src:
    Example: src=default%40gmail.com
    Format: src=text
    This is not covered by Google help but is an optional parameter
    in order to add an event to a shared calendar rather than a user's default.

text:
    Example: text=Garden%20Waste%20Collection
    Format: text=text
    This is a required parameter giving the event title.

dates:
    Example: dates=20090621T063000Z/20090621T080000Z 
           (i.e. an event on 21 June 2009 from 7.30am to 9.0am 
            British Summer Time (=GMT+1)).
    Format: dates=YYYYMMDDToHHMMSSZ/YYYYMMDDToHHMMSSZ
           This required parameter gives the start and end dates and times
           (in Greenwich Mean Time) for the event.

location:
    Example: location=Home
    Format: location=text
    The obvious location field.

trp:
    Example: trp=false
    Format: trp=true/false
    Show event as busy (true) or available (false)

sprop:
    Example: sprop=http%3A%2F%2Fwww.me.org
    Example: sprop=name:Home%20Page
    Format: sprop=website and/or sprop=name:website_name

add:
    Example: add=default%40gmail.com
    Format:  add=guest email addresses 
*/

function addGoogleCalendar(
    $name,
    $startdate,
    $enddate = false,
    $description = false,
    $location = false,
    $allday = false,
    $linktext = 'Add to my Google Calendar',
    $myCustomClass = array('button')
) {
    if ($allday) {
        $startdate = date('Ymd', strtotime($startdate));
    } else {
        $startdate = date('Ymd\THis', strtotime($startdate));
    }
    if ($enddate && !empty($enddate) && strlen($enddate) > 2) {
        if ($allday) {
            $enddate = date('Ymd', strtotime($enddate . ' + 1 day'));
        } else {
            $enddate = date('Ymd\THis', strtotime($enddate));
        }
    } else {
        $enddate = date('Ymd\THis', strtotime($startdate . ' + 2 hours'));
    }
    $url = 'http://www.google.com/calendar/event?action=TEMPLATE';
    $url .= '&text=' . rawurlencode($name);
    $url .= '&dates=' . $startdate . '/' . $enddate;
    if ($description) {
        $url .= '&details=' . rawurlencode($description);
    }
    if ($location) {
        $url .= '&location=' . rawurlencode($location);
        //https://www.php.net/manual/en/function.rawurlencode.php
        //rawurldecode() - Decode URL-encoded strings
    }
    $output = '<a href="' . $url . '" class="' . implode(' ', $myCustomClass) . '">' . $linktext . '</a>';
    return $output;
}

echo addGoogleCalendar(
    'Webinar.hostgator.com.br (Title)',
    'June 30, 2017 8:00pm',
    'July 2, 2017 10:00am',
    'Teste agendamento Webinar (description)',
    'Rua Lauro Linhares, 589, Ático - Trindade, Florianópolis - SC, CEP 88036-001'
);

/*
 *
 *  Example Usage:
 *
 *  echo addGoogleCalendar('Example Event', 'June 30, 2017 8:00pm');
 *  echo addGoogleCalendar('Example Event', 'June 30, 2017 8:00pm', 'July 2, 2017 10:00am', 'This is my detailed event description', '1600 Pennsylvania Ave NW, Washington, DC 20500');
 *  echo addGoogleCalendar('Example Event', 'June 30, 2017', 'July 2, 2017', 'This is my detailed event description', '1600 Pennsylvania Ave NW, Washington, DC 20500', true, 'gCal+', array('my-custom-class') );
 *
 */
?>