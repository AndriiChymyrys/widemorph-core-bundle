# Folder structure

## Domain folder
Contains domain logic of bundle

## Infrastructure folder
Contains classes that used by Symfony like **Command**, **EventListener**, **DependencyInjection** etc. Also, there should
be classes that interact with another services through api

## Interaction folder
Contains interaction classes between inner layers **infrastructure**, **domain**. Classes for interaction between bundles.
All services from extra bundles should not be received directly only through interaction classes.
Constant from extra bundle should be duplicated in interaction interface with the same name and value from extra bundle.

### Interaction/Bridge folder
Contains bridge classes between extra bundles. Bridge is mean class or interface which extends class or interface in
extra bundle. For example if you need to implement interface from extra bundle you need to create bridge interface
which extend interface from extra bundle and your class will extend bridge interface.

Bridge should be placed in sub folder named by extra bundle. For bundle MorphConfigBundle.php folder should be named
MorphConfig.

## Presentation folder
Contains controller, forms

## Resources
Contains resources of your bundle assets, service configs, views.
