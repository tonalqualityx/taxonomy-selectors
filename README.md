# taxonomy-selectors

This plugin is a simple plugin for building a quick, dynamic, nested select input element based on the terms in a given taxonomy. Here's how it works:

## Shortcode

``` [ind-taxonomy-selector]```

## Arguments

You may add arguments/attributes to the shortcode as follows:

* _tax (Default is 'category')_ - use the **slug** of the taxonomy.
* _id (Default is an empty string)_ - enter the id you'd like used on the select element.
* _name (Default is an empty string)_ - enter the name you'd like used on the select element. 
* _classes (Default is an empty string)_ - enter the classes you'd like used on the select element (you can just separate them with a space like you normally would)
* _hide_empty (Default is 'false')_ - If you'd like to hide the empty taxonomy terms (the ones that don't have any posts yet) set this to true.

## Usage

Use the shortcode like this:

```[ind-taxonomy-selector tax='my-custom-taxonomy' id='custom-select-element-id' name='my-custom-name' classes='big-select-box another-class' hide_empty='false']```

Produces

```
<select name="my-custom-name" id="custom-select-element-id" class="big-select-box another-class">
  <option class="level-0" value="antiques">Antiques</option>
  <option class="level-1" value="apartment-rentals">Apartment Rentals</option>
  <option class="level-2" value="apartment-wanted">Apartment Wanted</option>
  <option class="level-3" value="estate-sale">Estate Sale</option>
  <option class="level-1" value="auto-sale">Auto Sale</option>
  <option class="level-0" value="auction">Auction</option>
  <option class="level-0" value="barn-sale">Barn Sale</option>
  <option class="level-0" value="commercial-rentals">Commercial Rentals</option>
</select>
```

