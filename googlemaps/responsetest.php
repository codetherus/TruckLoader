<?php


$response = 
'{
 "kind": "coordinate#jobList",
 "nextPageToken": "1339008280772001",
 "items": [
  {
   "kind": "coordinate#job",      
   "id": "2502",
   "state": {
    "kind": "coordinate#jobState",
    "assignee": "mike@example.com",
    "location": {
     "kind": "coordinate#location",
     "lat": 37.421991,
     "lng": -122.08393,
     "addressLine": [
      "1600 Amphitheatre Pkwy, Mountain View CA 94043"
     ]
    },
    "note": [
     "Watch out for androids AND the Tyrannosaurus rex."
    ],
    "title": "Service call",
    "customerName": "Google",
    "customerPhoneNumber": "1-650-253-0000"
   },
   "jobChange": [
    {
     "kind": "coordinate#jobChange",     
     "timestamp": "1337798399271",
     "state": {
      "kind": "coordinate#jobState",
      "assignee": "",
      "location": {
       "kind": "coordinate#location",
       "lat": 37.421991,
       "lng": -122.08393,
       "addressLine": [
        "1600 Amphitheatre Pkwy, Mountain View CA 94043"
       ]
      },
      "note": [
       "Watch out for androids."
      ],
      "title": "Service call",
      "customerName": "Google",
      "customerPhoneNumber": "1-650-253-0000"
     }
    },
    {
     "kind": "coordinate#jobChange",     
     "timestamp": "1337799246820",
     "state": {
      "kind": "coordinate#jobState",
      "note": [
       "Watch out for androids AND the Tyrannosaurus rex."
      ]
     }
    },
    {
     "kind": "coordinate#jobChange",     
     "timestamp": "1337799311231",
     "state": {
      "kind": "coordinate#jobState",
      "assignee": "mike@example.com"
     }
    }
   ]
  },
  {
   "kind": "coordinate#job",     
   "id": "6413",
   "state": {
    "kind": "coordinate#jobState",
    "location": {
     "kind": "coordinate#location",
     "lat": 47.670188,
     "lng": -122.196335,
     "addressLine": [
      "747 6th St S, Kirkland WA 98033"
     ]
    },
    "title": "Maintenance appointment",
    "customerName": "Google Kirkland",
    "customerPhoneNumber": "(425) 739-5600"
   },
   "jobChange": [
    {
     "kind": "coordinate#jobChange",     
     "timestamp": "1339008280772",
     "state": {
      "kind": "coordinate#jobState",
      "assignee": "",
      "location": {
       "kind": "coordinate#location",
       "lat": 47.670188,
       "lng": -122.196335,
       "addressLine": [
        "747 6th St S, Kirkland WA 98033"
       ]
      },
      "title": "Maintenance appointment",
      "customerName": "Google Kirkland",
      "customerPhoneNumber": "(425) 739-5600"
     }
    }
   ]
  }
 ]
}';
$decoded = json_decode($response,true);
echo count($decoded).'<br>';
foreach ($decoded as $item){
var_dump($item);
}