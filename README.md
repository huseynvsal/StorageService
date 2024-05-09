## 1. Create Client

Run command: `php artisan passport:client --client`

## 2. Generate Token
API - `POST oauth/token` - _Generates an **Access Token** for given client credentials._

Expected response:

```
{
    "token_type": "Bearer",
    "expires_in": 7948800,
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIzIiwianRpIjoiYTZhZDY0NjZjYzIxNjc5MGY4NGJkNj..."
}
```
### **Request**
#### **HEADERS**

**Accept**: application/json
**Authorization**: Bearer _access_token_

#### **BODY** - formdata

**client_id**: 4
**client_secret**: QJv4nKCyI3rOA0IRs63C8gfnySt1GOjoLti3SAT7
**grant_type**: client_credentials

## 3. Upload File
API - `POST api/documents` - _Uploads file to S3 Storage_

Only accessible with **Access Token** in headers - `Authorization: Bearer {access_token}`

Expected response:

```
{
    "uuid": "51981985-1809-48ae-862b-ee689a437a68"
}
```
### **Request**
#### **HEADERS**

**Accept**: application/json
**Authorization**: Bearer _access_token_

#### **BODY** - formdata

**file**: _someFile.ext_

## 4. Get File
API - `GET api/documents/{uuid}` - _Gets file contents with uuid in url_

Only accessible with **Access Token** in headers - `Authorization: Bearer {access_token}`

Returns **file content** as response

### **Request**
#### **HEADERS**

**Accept**: application/json
**Authorization**: Bearer _access_token_

## 5. Delete File
API - `DELETE api/documents/{uuid}` - _Deletes file with uuid in url_

Only accessible with **Access Token** in headers - `Authorization: Bearer {access_token}`

Returns `null` response with **204** status code

### **Request**
#### **HEADERS**

**Accept**: application/json
**Authorization**: Bearer _access_token_
