---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost:8100/docs/collection.json)

<!-- END_INFO -->

#Matches
<!-- START_c43068b557e58a2f5071adb9dbe715f5 -->
## Get Match Data by Round ID

Finds a round, and fetches all match data related to it

> Example request:

```bash
curl -X GET -G "/api/round/1/matches" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL("/api/round/1/matches");

let headers = {
    "Authorization": "Bearer {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response:

```json
null
```

### HTTP Request
`GET api/round/{id}/matches`


<!-- END_c43068b557e58a2f5071adb9dbe715f5 -->

#Rounds
<!-- START_5d64795133b66ba929dfae79396990af -->
## Store a new Round

> Example request:

```bash
curl -X POST "/api/rounds" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL("/api/rounds");

let headers = {
    "Authorization": "Bearer {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


### HTTP Request
`POST api/rounds`


<!-- END_5d64795133b66ba929dfae79396990af -->

#Teams
<!-- START_47a6d03c132411b782ac114472f71770 -->
## Display a listing of the Teams

> Example request:

```bash
curl -X GET -G "/api/teams" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL("/api/teams");

let headers = {
    "Authorization": "Bearer {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response:

```json
null
```

### HTTP Request
`GET api/teams`


<!-- END_47a6d03c132411b782ac114472f71770 -->


