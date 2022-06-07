<?php
function timeAgo($time)
    {

        $time_prepare_in_time_ago_function = "";


        // Calculate difference between current
        // time and given timestamp in seconds
        $diff = time() + (60 * 60 * 5.5) - $time;

        // Time difference in seconds
        $sec = $diff;

        // Convert time difference in minutes
        $min = round($diff / 60);

        // Convert time difference in hours
        $hrs = round($diff / 3600);

        // Convert time difference in days
        $days = round($diff / 86400);

        // Convert time difference in weeks
        $weeks = round($diff / 604800);

        // Convert time difference in months
        $mnths = round($diff / 2600640);

        // Convert time difference in years
        $yrs = round($diff / 31207680);

        // Check for seconds
        if ($sec <= 60) {
            $time_prepare_in_time_ago_function = "$sec seconds";
        }

        // Check for minutes
        else if ($min <= 60) {
            if ($min == 1) {
                $time_prepare_in_time_ago_function = "one minute";
            } else {
                $time_prepare_in_time_ago_function = "$min minutes";
            }
        }

        // Check for hours
        else if ($hrs <= 24) {
            if ($hrs == 1) {
                $time_prepare_in_time_ago_function = "an hour";
            } else {
                $time_prepare_in_time_ago_function = "$hrs hours";
            }
        }

        // Check for days
        else if ($days <= 7) {
            if ($days == 1) {
                $time_prepare_in_time_ago_function = "Yesterday";
            } else {
                $time_prepare_in_time_ago_function = "$days days";
            }
        }

        // Check for weeks
        else if ($weeks <= 4.3) {
            if ($weeks == 1) {
                $time_prepare_in_time_ago_function = "a week";
            } else {
                $time_prepare_in_time_ago_function = "$weeks weeks";
            }
        }

        // Check for months
        else if ($mnths <= 12) {
            if ($mnths == 1) {
                $time_prepare_in_time_ago_function = "a month";
            } else {
                $time_prepare_in_time_ago_function = "$mnths months";
            }
        }

        // Check for years
        else {
            if ($yrs == 1) {
                $time_prepare_in_time_ago_function = "one year";
            } else {
                $time_prepare_in_time_ago_function = "$yrs years";
            }
        }

        return $time_prepare_in_time_ago_function;
    }

    ?>