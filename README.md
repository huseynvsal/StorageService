### ACESS_TOKEN
```
eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNmFlYWJjODJkMTMzZmM0ZWVlNjU4NjUwZmRkZDdiMmU1MGJiMjdkNzBhNzJmODc4MmUzODQ3ZmEzYjhmODRlODk0NmZjMWIzNWM0OTQ3ZDYiLCJpYXQiOjE2ODE3OTc3OTIuNjU4NTY3LCJuYmYiOjE2ODE3OTc3OTIuNjU4NTcsImV4cCI6NDgzNzQ3MTM5Mi42MjE5Nywic3ViIjoiIiwic2NvcGVzIjpbXX0.VuCyIZ6MGt6k-eKpEAbmaWeLB7QvHw67Slf6NqKrW-CuwNZ9KnEkGICnD19bnAFu4cbKlY_qycA69_6sPya3SqDyqN4lt3mixOemXv-ccCqWJoFBPbigLX6xrlZwugBM358ldUO8ppiWbKeKdmLpCUJvQltwgLTv5wXDhxB5WgCoM4aKA3_BoeeRf84phPOF55DWfPM17WtKTBLWbAwPGR8wRwoNz4O2F_8D2vE8-SOEIJcF4qs0tGqSa6QbcAe-MasrYNgQkFaD215IA0NwHIpCDRoo8Cgdc4PjUh8U59mB6xGz1jtazelWSdx794R25cW3BRMNH9f8fTzHLITatbGudBWVfdKNdB64_GB5Gpx4u5iqrah8WgheUf12elOzeHORh0Eau5ZgN85TjTcCB_m_fn_8dtF0gCJ9wySHW2ZlGxGy3yNn7Of9BPq6qSyW6cTSXFGvI3jLYK-8-Olsr8oSXSL_4SyLUtzvyzxK49RGsiQmibmF5l25-l51C3mn9YLusxQJLcNE0htUYCT-8_f49KHZDgvIDSTV7ZsIYS9BA3e9EIagdhR_nhQr1ZGxriPbay_nPaFW-ah4uhaNHilpmBQ9SAff12Gb0DVmTNZKD9G4R8u56MhWuQYYwZR2pk82CKCbd1oW-Mlbj4GMR45tMTc6yfEBAjrWh7Nn_E4
```

# [API documentation](https://api.postman.com/collections/14504099-d761f7a7-74a8-4631-aa81-78263bb1c5cb?access_key=PMAT-01GJ4RW0Q5GBGASZ84X9DCYEKF)
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
