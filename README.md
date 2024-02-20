# DwmdRemoveGuestOrder

## 🇩🇪 Shopware 6 Gastbestellungen entfernen

Shopware 6 bietet zum aktuellen Zeitpunkt nicht die Möglichkeit, Gastbestellungen einfach zu deaktivieren. Das Plugin überschreibt das Register-Template, um die Checkbox für Gastbestellungen zu entfernen. Somit muss der Kunde ein Kundenkonto anlegen und Bestellungen als Gast sind nicht mehr möglich.

## 🇬🇧 Shopware 6 remove guest orders

Shopware 6 does not currently offer the option to easily disable guest orders. The plugin overrides the register template to remove the checkbox for guest orders. Thus, the customer must create an account, and orders as a guest are no longer possible.


## Installation

1. download zip-file
2. upload in shopware administration: `Extensions > My extensions > Upload extension`
3. activate `DwmdRemoveGuestOrder` Plugin
4. clear cache via console `bin/console cache:clear` or `Settings > Caches & indexes > Clear caches`