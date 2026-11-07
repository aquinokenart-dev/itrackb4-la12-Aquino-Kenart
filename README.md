Lab # 12

H1
The top of your error page named a file inside vendor. Say why that was not where your mistake was, and where the page showed you it actually was.
-The top of the error page pointed to a file inside the `vendor/` directory because Laravel's framework code was the first to throw the exception when trying to call the non-existent method. However, the root cause was not in Laravel's internal core; the Exception trace frame opened further down specifically pointed to line numbers inside my `app/Http/Controllers/` controller file where the misspelled method name (the extra letter) was actually written.
H2
You wrote one Log::info line with a context array. Name something it will tell you next month that the error page could not.
-By passing a context array with `'id' => $record->id` to `Log::info()`, the log records the exact database primary key associated with that event. Next month, this context will immediately pinpoint which specific record triggered or completed an action, whereas a generic error page or log statement without context would only show that a method executed without identifying the impacted data.
H3
Your guard answers with 403 instead of redirecting back with a message. Say when each of the two is the better answer.
-Using an `abort(403)` is the proper response when a request violates core data integrity or security policy (such as attempting to delete the final item in a required group), explicitly stopping execution and telling the client they lack permission. Conversely, redirecting back with a user-facing alert message is better for standard form validation errors or expected workflow warnings, allowing the user to correct their input on the frontend without breaking their session flow.



