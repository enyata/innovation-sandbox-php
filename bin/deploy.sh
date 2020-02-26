echo "using " $PACKAGIST_PACKAGE_URL
curl -XPOST -H"content-type:application/json" "https://packagist.org/api/update-package?username=$USERNAME&apiToken=$API_TOKEN" -d"{\"repository\":{\"url\":\"$PACKAGIST_PACKAGE_URL\"}}"
