FORMAT: 1A

# Api Documentation

# AppHttpControllersAPIV1AuthController

## Login user [POST /auth/login]
login with a `username` and `password`.

+ Request (application/json)
    + Body

            {
                "username": "foo1",
                "password": "bar"
            }

+ Response 200 (application/json)
    + Body

            {
                "status": "ok",
                "token": "{token}",
                "user": []
            }

+ Response 401 (application/json)
    + Body

            {
                "error": "invalid_credentials"
            }

## Register user [POST /auth/register]
Register a new user with a `username` and `password`.

+ Request (application/json)
    + Body

            {
                "user": "foo",
                "password": "bar"
            }

+ Response 200 (application/json)
    + Body

            {
                "status": "ok",
                "token": "{token}",
                "user": []
            }

+ Response 401 (application/json)
    + Body

            {
                "error": "invalid_credentials"
            }

## Resend Confirmation Mail [POST /auth/resend-confirmation]


+ Request (application/json)
    + Body

            {
                "email": "sample@gmail.com"
            }

+ Response 200 (application/json)
    + Body

            {
                "email": "sent"
            }

# AppHttpControllersAPIV1CategoriesController

## Categories [GET /categories]
get all categories

# AppHttpControllersAPIV1SlidesController

## Slides [GET /slides]
get all slides

# AppHttpControllersAPIV1CompaniesController

## Approved companies [GET /companies]
get all Approved Companies

## Get company [GET /companies]
get a company by id

## Get products [GET /companies/{id}/products]
Get products by company id

+ Parameters
    + page: (string, optional) - For getting specific page data
        + Default: 1
    + search: (string, optional) - for searching products
    + category: (string, optional) - for filtering category id wise

# AppHttpControllersAPIV1ImageController

## Get Resize Image [GET /resize-image]
Get resize image url

+ Parameters
    + type: (string, optional) - example 200X200
        + Default: 200X200
    + path: (string, optional) - path of image

# AppHttpControllersAPIV1ProductsController

## Get products [GET /companies/{id}/products]
Get products by company id

+ Parameters
    + category: (string, optional) - Category slug
    + lower_price: (string, optional) - price lower price
    + upper_price: (string, optional) - price upper price
    + search: (string, optional) - price upper price
    + order_by: (string, optional) - lowest_price or highest_price