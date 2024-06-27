/* eslint-disable */
'use strict';

require('dotenv').config({ path: '../../../.env' });

import {
  DETAIL_PROFILE_ENDPOINT,
  LOGIN_ENDPOINT,
  UPDATE_PASSWORD_ENDPOINT,
  UPDATE_PROFILE_ENDPOINT,
  REGISTER_ENDPOINT
} from './endpoints';
import ApiFactory from '../ApiFactory';

const AuthenticateApi = new ApiFactory({ url: process.env.REACT_APP_API_ENDPOINT });

AuthenticateApi.createEntities([
  { name: LOGIN_ENDPOINT },
  { name: DETAIL_PROFILE_ENDPOINT },
  { name: UPDATE_PASSWORD_ENDPOINT },
  { name: REGISTER_ENDPOINT },
  { name: UPDATE_PROFILE_ENDPOINT }
]);

const loginUserApi = data => AuthenticateApi.createBasicCRUDEndpoints({ name: LOGIN_ENDPOINT }).post(data);
const registerUserApi = data => AuthenticateApi.createBasicCRUDEndpoints({ name: REGISTER_ENDPOINT }).post(data);

const fetchProfileDetail = (data, config) =>
  AuthenticateApi.createBasicCRUDEndpoints({ name: DETAIL_PROFILE_ENDPOINT }).get(data, config);
const updateProfileDetail = data =>
  AuthenticateApi.createBasicCRUDEndpoints({ name: DETAIL_PROFILE_ENDPOINT }).update(data);

const updatePasswordUser = data =>
  AuthenticateApi.createBasicCRUDEndpoints({ name: UPDATE_PASSWORD_ENDPOINT }).put(data);

export { loginUserApi, registerUserApi, fetchProfileDetail, updatePasswordUser, updateProfileDetail };
