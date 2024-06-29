<?php

// Redis Config
// TYPE: LIST_, COUNT_, DETAIL_,

return [
  'COOKIES_SESSION_TIME' => 10080,

  'LANGUAGE_LOCALE' => [
    'EN_LANGUAGE' => [
      'shortcodes' => 'en',
      'name' => 'English',
      'iso_code' => 'en_US',
      'flag_path' => 'img/flags/en.png',
    ],
    'VI_LANGUAGE' => [
      'shortcodes' => 'vn',
      'name' => 'Vietnamese',
      'iso_code' => 'vi_VN',
      'flag_path' => 'img/flags/vn.png',
    ],
    'HI_LANGUAGE' => [
      'shortcodes' => 'hi',
      'name' => 'Hindi',
      'iso_code' => 'hi_IN',
      'flag_path' => 'img/flags/hi.png',
    ],
    'ZH_LANGUAGE' => [
      'shortcodes' => 'zh',
      'name' => 'Chinese',
      'iso_code' => 'zh_CN',
      'flag_path' => 'img/flags/zh.png',
    ],
    'ID_LANGUAGE' => [
      'shortcodes' => 'id',
      'name' => 'Indonesian',
      'iso_code' => 'id_ID',
      'flag_path' => 'img/flags/id.png',
    ],
    'AR_LANGUAGE' => [
      'shortcodes' => 'ar',
      'name' => 'Arabic',
      'iso_code' => 'ar_SA',
      'flag_path' => 'img/flags/ar.png',
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
  'BLOG_CATEGORIES_ENDPOINT' => '/admin/news/categories',
];


const VI_LANGUAGE = 'vi';
const EN_LANGUAGE = 'en';
const HI_LANGUAGE = 'hi';
const ZH_LANGUAGE = 'zh';
const ID_LANGUAGE = 'id';
const AR_LANGUAGE = 'ar';
const DEFAULT_LANGUAGE = 'en';
