<?php

return [
  'tableColumns' => [
      'Payment Status',
      'Status',
      'Phone Number',
      'Email',
      'Password',
      'Recovery Mail',
      'First Name',
      'Last Name',
      'Gmb Listing Name',
      'Bussiness Type',
      'Category',
      'Street',
      'City',
      'State',
      'Zip',
      'State Code',
      'Creation Date',
  ],
  'finalColumns' => [
      'Email',
      'Phone Number',
      'Store Code',
      'Bussiness Name',
      'Address Line 1',
      'Address Line 2',
      'Address Line 3',
      'Address Line 4',
      'Address Line 5',
      'Sub Locality',
      'Locality',
      'Administrative Area',
      'Country Region',
      'Postal Code',
      'Latitude',
      'Longitude',
      'Primary Phone',
      'Additional Phones',
      'Website',
      'Primary Category',
      'Additional Categories',
      'Sunday Hours',
      'Monday Hours',
      'Tuesday Hours',
      'Wednesday Hours',
      'Thursday Hours',
      'Friday Hours',
      'Saturday Hours',
      'Special Hours',
      'From The Bussiness',
      'Logo Photo',
      'Cover Photo',
      'Other Photos',
      'Labels',
      'AdWords location extensions phone',
      'Amenities: Wi-Fi (wi_fi)',
      'Highlights: Women-Led (is_owned_by_women)',
      'Payments: Credit cards American Express',
      'Payments: Credit cards Master Card',
      'Payments: Credit cards Visa Card',
      'Place page URLs: Menu link (url_menu)',
      'Status'
  ],
  'editColumns' => [
      'Payment Status',
      'Status',
      'Email',
      'Phone Number',
      'Recovery Email',
      'Password',
      'GMB Listing Name',
      'Bussiness Type',
      'GMB Category',
      'First Name',
      'Last Name',
      'Steet Address',
      'City',
      'Zip',
      'State',
      'State Abbrev.',
      'Creation Date',
  ],

  'status' => [
    'Verified',
    'Hard Pending',
    'Soft Pending',
    'Post Card',
    'Suspended',
    'Skipped'
  ],

  'paymentStatus' => [
    'In Progress',
    'Active Needs Payment',
    'Rejected'
  ],

  'finalPaymentStatus' => [
    'Need Payments',
    'Paid',
  ],

  'paymentTable' => [
    'Date Stamp',
    'Email',
    'Phone Number',
    'First Name',
    'Last Name',
    'Verified Emails',
    'Payment Type',
    'Payment Id',
    'Referred By',
    'Final Payment Status',
  ],

  'permissions' => [
    'Create',
    'Edit',
    'Final',
    'Pay',
  ],
  'setup_permissions' => [
    'email',
    'address',
    'final',
  ],
  'paymentType' => [
    'Paypal',
    'CashApp',
    'Venmo',
  ],
  'publishedStatus' => [
    'Pending',
    'Published',
  ]
];
