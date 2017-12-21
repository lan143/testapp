define({ "api": [
  {
    "type": "post",
    "url": "/promocodes/activate",
    "title": "Activate promocode by name and tariff zone",
    "name": "ActivatePromocode",
    "group": "Promocodes",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Promocode name.</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "tariff_zone",
            "description": "<p>Promocode tariff zone id.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "client_reward",
            "description": ""
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "web/scripts/api.js",
    "groupTitle": "Promocodes"
  },
  {
    "type": "get",
    "url": "/promocodes/search",
    "title": "Search promocodes by name",
    "name": "SearchPromocodes",
    "group": "Promocodes",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Promocode name part.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "client_reward",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "date_start",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "date_end",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "status_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "tariff_zone.id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "tariff_zone.name",
            "description": ""
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "web/scripts/api.js",
    "groupTitle": "Promocodes"
  }
] });
