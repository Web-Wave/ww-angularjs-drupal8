# ww-angularjs-drupal8
A custom module for drupal 8, this is an example module for use angularjs in a drupal 8 Website.

This module render a search page who give you an auto complete search on field name.
When you validate the search form, a popup is displayed with all information related to this name.

This popup is feed by an angular script who take all data from a view.
Into the controller you can change the content type used for this example who is 'name'.

So, to use this module you have to create a view, write the url in this file :

```
assets/js/ww_angularjs_drupal8_angular.js
```

And adapt the angular script with your own fields. Don't forget to adapt the template file in this modules.
