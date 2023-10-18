# v1.2.2

## 18/10/2023

1. [](#bugfix)
   - Fixing coding error which prevented install/removal of the plugin.

# v1.2.1

## 12/03/2019

1. [](#improved)
   - Using the last version of FontAwesome by loading the Javascript file.
1. [](#improved)
   - You can now pick which kind of icon you want to use (Brand, Solid or Regular)
1. [](#improved)
   - Removed Google Plus entry as Google Plus is no more. (RIP)

# v1.2.0

## 01/23/2019

1. [](#improved)
   - The description HTML tag is now a div.
2. [](#improved)
   - The Gravatar size field type is now a number.
3. [](#new)
   - Added a toggle for the job / title field.
4. [](#new)
   - Added support for multi-language.
5. [](#improved)
   - Fixed documentation markdown titles.

# v1.1.5

## 10/17/2016

1. [](#bugfix)
   - When the template was included in a page content with twig processing enabled, twig variables were not set in some cases (ie: with Shortcode plugin enabled, that might be the case for other plugins involving page content).
2. [](#bugfix)
   - Using raw filter in the template for more theme compatibility.

# v1.1.4

## 09/09/2016

1. [](#bugfix)
   - There were some issues when changing fields value of the plugin from the admin page; due to changes to the file upload system and merging system between user config file and plugin config file.

# v1.1.3

## 07/07/2016

1. [](#improved)
   - Grav 1.1 (RC3) uses arrays instead of simple string for files uploaded in plugins/themes. The plugin now works for Grav 1.0 and 1.1 (RC3)

# v1.1.2

## 04/21/2016

1. [](#improved)
   - The description can now contains markdown and break lines

# v1.1.1

## 03/03/2016

1. [](#bugfix)
   - Fix hardcoded `http` reference for gravatar that breaks https websites

# v1.1.0

## 12/25/2015

1. [](#improved)
   - Changed the social pages feature. You can now pick a different font icon from font-awesome, change the order the links will appear in, and also change the title which will appear when the icon is hovered. You might want to change your own `aboutme.yaml` in your user config with the new `aboutme.yaml` so the plugin does not break
2. [](#bugfix)
   - The source of the avatar was broken when used with multi-languages. It's now fixed

# v1.0.0

## 12/21/2015

1. [](#new)
   - First Version
   - ChangeLog started...
