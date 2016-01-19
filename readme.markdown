# LibCal proxy

Middle-person page for passing requests to LibCal's API server, adding an
`Access-Control-Allow-Origin: "*"` header, which will stop the following browser
error from popping up:

```
Cross-Origin Request Blocked: The Same Origin Policy disallows reading the remote
resource at http://api3.libcal.com/api_hours_grid.php?iid=814&format=json&weeks=52.
(Reason: CORS header 'Access-Control-Allow-Origin' missing).
```

There are two configurable options that you'll have to edit `index.php` to modify:

* **Line 8**:  set `$force_json_response` to `true` to force a
  `Content-type: application/json` header
* **Line 11**: add an origin value for the `Access-Control-Allow-Origin`
