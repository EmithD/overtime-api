<?php

namespace App\Models\Utilities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppMessages extends Model
{
    use HasFactory;

    static $SUCCESS = "Successful";
    static $UPDATED = "Successfully Updated";
    static $NOT_FOUND = "Error: Record Not found";
    static $ERROR = "An Error Occurred";
    static $FETCHED = "Record has been fetched successfully";
    static $FETCH_ALL = "Fetch successful";
    static $CREATED = "Record created successfully";
    static $AUTHORIZED = "User has been authenticated";
    static $UNAUTHORIZED = "Invalid user";
    static $EXIT = "User has been logged out";
    static $USER_REMOVED = "User has been removed";
    static $USER_NOTFOUND = "User already removed";
}
