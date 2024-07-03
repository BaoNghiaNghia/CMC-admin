<?php

// Redis Config
// TYPE: LIST_, COUNT_, DETAIL_,

return [
  'COOKIES_SESSION_TIME' => 10080,

  'LANGUAGE_LOCALE' => [
    'EN_LANGUAGE' => [
      'shortcodes' => 'en_US',
      'name' => 'English',
      'iso_code' => 'en',
      'flag_path' => 'assets/img/en_US.png',
    ],
    'VI_LANGUAGE' => [
      'shortcodes' => 'vn_VN',
      'name' => 'Vietnam',
      'iso_code' => 'vi',
      'flag_path' => 'assets/img/vi_VN.png',
    ],
    'HI_LANGUAGE' => [
      'shortcodes' => 'hi_IN',
      'name' => 'India',
      'iso_code' => 'hi',
      'flag_path' => 'assets/img/hi_IN.png',
    ],
    'ZH_LANGUAGE' => [
      'shortcodes' => 'zh_CN',
      'name' => 'China',
      'iso_code' => 'zh',
      'flag_path' => 'assets/img/zh_CN.png',
    ],
    'ID_LANGUAGE' => [
      'shortcodes' => 'id_ID',
      'name' => 'Indonesian',
      'iso_code' => 'id',
      'flag_path' => 'assets/img/id_ID.png',
    ],
    'AR_LANGUAGE' => [
      'shortcodes' => 'ar_SA',
      'name' => 'Arabic',
      'iso_code' => 'ar',
      'flag_path' => 'assets/img/ar_SA.png',
    ],
  ],

  // Authen Endpoints
  'LOGIN_ENDPOINT' => '/users/login',
  'UPDATE_PASSWORD_ENDPOINT' => '/users/password',
  'DETAIL_PROFILE_ENDPOINT' => '/users/profile',
  'UPDATE_PROFILE_ENDPOINT' => '/users/profile',
  'REGISTER_ENDPOINT' => '/users/register',

  // Blogs Endpoints
  'IMAGES_LIBRARY_ENDPOINT' => '/library',
  'IMAGE_UPLOAD_ENDPOINT' => '/upload',
  'PUBLISH_POST_ENDPOINT' => '/admin/blog/news',
  'BLOG_TAGS_ENDPOINT' => '/admin/news/tags',
  'AUTHORS_ENDPOINT' => '/admin/news/authors',
  'BLOG_CATEGORIES_ENDPOINT' => '/admin/blog/categories',
];
