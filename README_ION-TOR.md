# ION-TOR SDK for Single Board Computers Running Linux

## Overview

The ION-TOR SDK for Single Board Computers (SBC) like Raspberry-PI, Intel Edison, Beagle Bone is a collection of source files that enables you to connect to the ION-TOR service. It includes the tor libraries to connect to TOR network. It is distributed in the application form and intended to be built into customer solution along with other libraries.

## Features

The ION-TOR-SDK simplifies access to the TOR network and automatically configures a .onion **DNS** name along with a hidden service for accessing a UI on a TOR browser.
The SDK installs all necessary software and creates a simple web UI through which sensor data can be viewed and actuators controlled.
The SDK has been tested to work on the Raspberry Pi 3 running Raspbian Jessie. Support for Other SBC's running any flavors of Linux would be available shortly.

## TOR Network

TOR directs Internet traffic through a worldwide, volunteer network consisting of more than seven thousand relays to conceal a user's location and usage from anyone conducting network surveillance or traffic analysis.

## Pre-Requisites

Need Raspberry pi with an Internet connection and a TOR browser.

## Installation

Download the SDK or clone it using the command below.

```
$ git clone github.com/PaasmerIoT/ION-TOR-SDK.git
$ cd ION-TOR-SDK
```

#### To connect the device to ION-TOR Network, the following steps need to be performed

To install hostapd to start WiFi access point, execute the following command 

```
$ sudo ./install-hostapd
```

Upon successful completion of the above command, the device will reboot.

After reboot, to install all dependency software like LAMP server,  execute the following command 

```
$ sudo ./Install-LAMP.sh
```

While installing LAMP server, it will ask password for MYSQL server. The password must be 8 characters and should be alphanumeric.

After successful installation of LAMP server, need to install ION-TOR. To install ION-TOR use the command

```
$ sudo ./Install-ION-TOR.sh
```

It will install ION-TOR software and it will ask for the password of your local MYSQL server, you just provided in the above step.

After successful installation of ION-TOR, To view the .onion DNS name, run the following command.

```
$ sudo cat /var/lib/tor/hidden_service/hostname
```
It will show a .onion DNS name like

```
$ 5fkilvtfgr6avva7.onion UHrjuj4gNd2SFnzLVvt7IB # client: haremote1
```

Use that DNS name to view the **PAASMER-ION-TOR** web page in Tor Browser.

After Installing all Softwares, need to reboot the device with the following command

```
$ sudo reboot now
```

After reboot, edit the config.php file to include the device name, feed names and GPIO pin details.

```
$sensor1name = ""; //feed name used for display in the PAASMER-ION-TOR web UI

$sensor1pin = ""; //modify with the pin number which you connected the sensor, eg 6 or 7 or 22

$sensor2name = ""; //feed name used for display in the PAASMER-ION-TOR web UI

$sensor2pin = ""; //modify with the pin number which you connected the sensor, eg 6 or 7 or 22

$sensor3name = ""; //feed name used for display in the PAASMER-ION-TOR web UI

$sensor3pin = ""; //modify with the pin number which you connected the sensor, eg 6 or 7 or 22

$sensor4name = ""; //feed name used for display in the PAASMER-ION-TOR web UI

$sensor4pin = ""; //modify with the pin number which you connected the sensor, eg 6 or 7 or 22

$control1name = ""; //feed name used for display in the PAASMER-ION-TOR web UI

$control1pin = ""; //modify with the pin number which you connected the control device (eg.: motor)

$control2name = ""; //feed name used for display in the PAASMER-ION-TOR web UI

$control2pin = ""; //modify with the pin number which you connected the control device (eg.: fan)

$devicename = ""; //your device name

$timedelay =  ""; //change the time delay as you required for sending sensor values to paasmer cloud

```

After editing, run the paasmer-ION-TOR.php file with the following command

```
$ php paasmer-ION-TOR.php
```

The device would now able to send sensor values at specified intervals.

## Tor Client Access Setup

Using this setup, you can access your PAASMER-ION-TOR instance over Tor from your laptop or mobile device, using Tor Browser and other software.

Add the authentication cookie to your torrc client configuration on your laptop or mobile device. Using the sample values from above, it would look like this:
```
HidServAuth abcdef1234567890.onion ABCDEF1122334455667789
```

For Tor Browser on Windows, Mac or Linux, you can find the torrc file here: `<tor browser install directory>/Browser/TorBrowser/Data/Tor/torrc-defaults`

Once you have added the entry, restart the browser, and then browse to the "dot onion" site address to connect to your PAASMER-ION-TOR instance.

## Support

The support forum is hosted on the GitHub, issues can be identified by users and the Team from Paasmer would be taking up requests and resolving them. You could also send a mail to support@paasmer.co with the issue details for a quick resolution.

## Note

The ION-TOR-SDK utilizes the features provided by TOR service.


