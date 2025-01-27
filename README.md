# Anonymous Email Forwarding

This is the source code for self-hosting AnonAddy.

## FAQ

#### **Why is it called AnonAddy?**

AnonAddy is short for "Anonymous Email Address". The word "Addy" is internet slang for email address, e.g.

> "My email addy is being spammed. I should've kept it private."

#### **Why did you make this site?**

I made this service after trying a few other options that do a similar thing. I was really interested in how they worked and loved the thought of protecting my real email addresses from spam.

I also wanted to address some issues with other services such as:

* Proprietary closed source code
* Adverts, analytics and trackers used on the sites
* No option to encrypt emails using a GPG/OpenPGP key
* No option for multiple recipients

I made the code open-source to show everyone what was going on behind the scenes and to allow others to help improve the application.

I use this service myself for the vast majority of sites I'm signed up to.

#### **Why should I use AnonAddy?**

There are a number of reasons you should consider using this service:

* Protect your real email address from spam by simply deactivating/deleting aliases that receive unsolicited emails
* Identify who has sold your data by using a different email address for every site
* Protect your identity in the event of a data breach by making it difficult for hackers to cross-reference your accounts
* Prevent inbox snooping by encrypting all inbound emails using GPG/OpenPGP encryption
* Update where emails are forwarded without having to go through and change your email address for each site individually
* Reply to forwarded emails anonymously without revealing your true email address

#### **Do you store emails?**

No I definitely do not store/save any emails that pass through the server.

#### **Can I use my own domain?**

Yes you can use your own domain name so you can also have *@example.com as your aliases. To do so you simply need to add an MX record to your domain so that our server can handle incoming emails.

#### **Why should I use this instead of a similar service?**

Here are a few reasons I can think of:

* Bring your own GPG/OpenPGP key to encrypt your forwarded emails (and the option to replace subjects)
* No adverts
* No analytics or trackers (just server access logs)
* No third party content (excluding stripe.js on the subscription page)
* Open-source application code
* No limitation on the number of aliases that can be created
* Generous monthly bandwidth
* Multiple domains to choose for aliases (currently anonaddy.com, anonaddy.me and another for paid plan users)
* Ability to generate UUID aliases
* Ability to add additional usernames to compartmentalise aliases
* New features added regularly

#### **Is there a browser extension?**

Yes there is an [open-source](https://github.com/anonaddy/browser-extension) browser extension available to download for [Firefox](https://addons.mozilla.org/en-GB/firefox/addon/anonaddy/) and [Chrome](https://chrome.google.com/webstore/detail/anonaddy/iadbdpnoknmbdeolbapdackdcogdmjpe) (also available on other chromium based browsers such as Brave and Vivaldi). You can use the extension to generate UUID aliases remotely.

#### **How do I add my own GPG/OpenPGP key for encryption?**

On the recipients page you simply need to click "Add public key" and paste in your **public** key data. Now all emails forwarded to you will be encrypted with your key. You should also replace the subject line of forwarded messages in your account settings as this cannot be encrypted.

#### **Are attachments encrypted too?**

Yes attachments are part of the email body and are also encrypted if you have it enabled.

#### **Are forwarded emails signed when encryption is enabled?**

Yes when you have encryption enabled all forwarded emails are signed using our mailer@anonaddy.me private key.

You can add this key to your own keyring so that you can verify emails have come from us.

The fingerprint of the mailer@anonaddy.me key is "26A987650243B28802524E2F809FD0D502E2F695" you can find the key on [https://keys.openpgp.org](https://keys.openpgp.org/search?q=26A987650243B28802524E2F809FD0D502E2F695).

#### **What if I don't want anyone to link ownership of my aliases together?**

If you're concerned that your aliases are all linked by your username e.g. @johndoe.anonaddy.com, then you have a couple of options:

1. You can generate UUID aliases instead, these are all under the root domain and cannot be linked to a user.
2. You can add additional usernames and separate your aliases under your these. e.g. you could have one username for personal stuff, another for work, another for hobbies etc.

#### **Where is the server located?**

The server is located in Amsterdam, Netherlands with [Greenhost.net](https://greenhost.net/). Greenhost focuses greatly on privacy and security and their servers run entirely on Dutch wind energy.

#### **What if I don't trust you?**

It's good to keep your guard up when online so you should never trust anyone 100%. I'll try my best to be as honest and transparent as I can but if you still aren't convinced you can always just fire up your own server and self-host this application. You'll need to know about server administration and PHP. I'll be adding more details on how to do this soon.

#### **What is the maximum number of recipients I can add to an alias?**

The limit is currently set to 10 which should suffice in the vast majority of situations.

#### **What happens when I delete my account?**

When you delete your account the following happens:

* All of your recipients are deleted from the database
* All of your aliases are deleted from the database
* All of your custom domains are deleted from the database
* Your user details are deleted from the database
* Your username and any additional usernames that you created are encrypted and added to a table in the database. This is to prevent anybody signing up with the same username in the future.
* Any subscription information is deleted from the database

#### **Does this work with any email provider?**

Yes this will work with any provider, althought I can't guarantee it won't land in spam initially.

#### **Will people see my real email if I reply to a forwarded one?**

No, your real email will not be shown, the email will look as if it has come from us instead. Just make sure not to include anything that might identify you when composing the reply, i.e. your full name.

#### **Can emails have attachments?**

Yes you can add attachments to emails forwarded and replies. Attachments count towards your bandwidth.

#### **What is the max email size limit?**

The max email size is currently set to 10MB (including attachments).

#### **What happens if I have a subscription but then cancel it?**

If you cancel your subscription it will remain active until the end of your current billing cycle, you will still be able to use your paid plan features until the billing cycle ends.

A few days before your billing cycle ends you will receive an email letting you know the steps you need to take to prevent the loss of any emails. Shortly after ending the following will happen:

* Any custom domains will be **deactivated**
* Any additional usernames will be **deactivated**
* If you have any more than **2 recipients** they will be **deleted**
* Paid account settings will be reverted to default values
* Any aliases using paid plan only domains will be **deactivated**
* If you have any more than 20 UUID aliases they will be **deactivated**

You will not be able to activate any of the above again until you resubscribe.

#### **How do you prevent spammers?**

The following is in place to help prevent spam:

* SpamAssassin - score threshold of 5.0
* DNS blacklist checks - spamhaus.org
* SPF, DKIM - to check the SPF record on the sender's domain
* DMARC - to check for email spoofing and reject emails that fail
* FQDN - the sender must be using a valid fully qualified domain name
* PTR record check - if the sender has no valid PTR record it is rejected

#### **What do you use to do DNS lookups on domain names?**

The server is running a local DNS caching server to improve the speed of queries. DNS.WATCH resolvers are used as a fallback.

#### **Is there a limit to how many emails I can forward?**

Not unless you are really going to town. Each user is throttled to 200 emails per hour through the server.

#### **Is there a limit to how many aliases I can create?**

Currently you are limited to creating 10 new aliases per hour on the free plan, 20 per hour on the Lite plan and 50 per hour on the Pro plan. If you try to create more than this the emails will be deferred until you are back below the limit.

#### **How is my bandwidth calculated?**

Each time a new email is received Postfix calculates its size in bytes. A column in the database is then simply incremented by that size when the email is forwarded or a reply is sent. At the start of each month your bandwidth is reset to 0.

I don't use rolling 30 day total as the only way to do this would be to log the date and size of every single email received.

Blocked emails do not count towards your bandwidth (e.g. an alias is inactive or deleted).

#### **How many emails can I receive before I go over my bandwidth limit?**

The average email is about 76800 bytes (75KB), this is roughly equivalent to 7,000 words in plain text. So the 10MB monthly allowance would be around 140 emails, the Lite plan's 50MB would be almost 700 emails and the Pro plan's 500MB would be almost 7,000 emails.

#### **What happens if I go over my bandwidth limit in a given month?**

If you get close to your limit you'll be sent an email letting you know. If you continue and go over your limit the server will start discarding emails until your bandwidth resets the next month.

#### **Can I login using an additional username?**

You can add 1 additional username as a Lite user and up to 3 additional usernames as a Pro user for totals of 2 and 4 respectively (including the one you signed up with). You can currently only login with the one that you originally signed up with.

#### **I'm not receiving any emails, what's wrong?**

Please make sure to add mailer@anonaddy.me to your address book and check your spam folder. Make sure to mark emails from us as safe if they turn up in spam.

If an alias has been previously deleted and you try to send email to it, the emails will bounce with an error message - "554 5.7.1 Recipient address rejected: Access denied".

Check that you have not deactivated the alias, custom domain or additional username. When any of these are deactivated, emails will be silently discarded, they will not bounce or return any error message.

The sender of the email may be failing SPF, DMARC or DNS blacklist checks resulting in the email being rejected. The sender should also have correct reverse DNS setup and use a FQDN as their hostname.

If you are forwarding emails to an icloud.com email address some users are having issues with a small number of emails bouncing (often those from Facebook).

For some reason Apple seems to think these emails are spam and returns this error message:

> Diagnostic-Code: smtp; 550 5.7.1 [CS01] Message rejected due to local policy.

I have contacted Apple multiple times about this but they have not yet responded.

If you still aren't receiving emails please contact me.

#### **How do I know this site won't disappear next month?**

I am very passionite about this project. I use it myself everyday and will be keeping it running indefinitely.

#### **Is the application tested?**

Yes it has over 130 automated PHPUnit tests written.

#### **How do I host this myself?**

You will need to set up your own server with Postfix so that you can pipe the received mail to the application. You can find more information here [https://github.com/anonaddy/anonaddy#self-hosting](https://github.com/anonaddy/anonaddy#self-hosting).

#### **Who's behind AnonAddy?**

My name is Will Browning, I'm a web developer from the UK and an advocate for online privacy and open-source software. You can find me on [Twitter](https://twitter.com/willbrowningme) although I don't tweet that much!

#### **I couldn't find an answer to my question, how can I contact you?**

For any other questions just send an email to - [contact@anonaddy.com](mailto:contact@anonaddy.com) ([5FCAFD8A67D2A783CFF4D0E31AC6D923E6FB4EF7](https://keys.openpgp.org/search?q=5FCAFD8A67D2A783CFF4D0E31AC6D923E6FB4EF7))

## Self Hosting

#### Prerequisites

* Postfix (3.0.0+) (plus postfix-mysql for database queries)
* PHP (7.2+) and the [php-mailparse](https://pecl.php.net/package/mailparse) extension plus the [php-gnupg](https://pecl.php.net/package/gnupg) extension if you plan to encrypt forwarded emails
* Port 25 unblocked and open
* Redis (4.x+) for throttling and queues
* FQDN as hostname e.g. mail.anonaddy.me
* MariaDB / MySQL
* Nginx
* SpamAssassin, Amavis, OpenDKIM, OpenDMARC, postfix-policyd-spf-python
* DNS records - MX, SPF, DKIM, DMARC
* Reverse DNS
* SSL/TLS Encryption - you can install a free certificate from Let’s Encrypt.

#### Postfix configuration

In `/etc/postfix/master.cf` you need to make sure it has this at the top:

```cf
smtp       inet  n       -       -       -       -       smtpd
        -o content_filter=anonaddy:dummy
```

This should be the only line for smtp.

Then add these lines to the bottom of the file:

```cf
anonaddy unix - n n - - pipe
  flags=F user=youruser argv=php /path/to/your/webapp/artisan anonaddy:receive-email --sender=${sender} --recipient=${recipient} --local_part=${user} --extension=${extension} --domain=${domain} --size=${size}
```

Making sure to replace `youruser` with the username of the user who will run the artisan command and also to update the /path to your installation.

This is what will pipe the email through to our applicaton so we can determine who the alias belongs to and who to forward the email to.

In order for Postfix to REJECT or DISCARD emails sent to deleted or deactivated aliases you need to ceate a file called `/etc/postfix/mysql-recipient-access.cf`.

In this file enter the following:

```
user = your_database_user
password = your-database-password
hosts = 127.0.0.1
dbname = your_database_name
query = CALL block_alias('%s')
```

This query calls a stored procedure that we will create next, it passes the recipient's email address as the argument.

Update the permissions of this file:

```bash
chmod o= /etc/postfix/mysql-recipient-access.cf
chgrp postifx /etc/postfix/mysql-recipient-access.cf
```

Either from the command line or from an SQL client, run the following code to create the stored procedure.

You will need to set appropriate permissions for your database user to allow them to execute the stored procedure.

```sql
DELIMITER $$

USE `your_database_name`$$

DROP PROCEDURE IF EXISTS `block_alias`$$

CREATE DEFINER=`your_database_user`@`localhost` PROCEDURE `block_alias`(alias_email VARCHAR(254))
BEGIN
   UPDATE aliases SET
    emails_blocked = emails_blocked + 1
   WHERE email = alias_email AND active = 0 LIMIT 1;
   SELECT IF(deleted_at IS NULL,'DISCARD','REJECT') AS alias_action
   FROM aliases WHERE email = alias_email AND (active = 0 OR deleted_at IS NOT NULL) LIMIT 1;
 END$$

DELIMITER ;
```

Making sure to replace `your_database_name` with the name of your own database and `your_database_user` with the name of your database user with permission to access your database.

Make a test call for the stored procedure as your database user to ensure everything is working as expected.

```sql
CALL block_alias('email@example.com')
```

Next we need to edit `/etc/postifx/main.cf` to include the above file. So find `smtpd_recipient_restrictions` and add the following line:

```
smtpd_recipient_restrictions =
   ...
   check_recipient_access mysql:/etc/postfix/mysql-recipient-access.cf,
   ...
```

Now incoming emails will be checked against your database to see if they are deactivated or have been deleted and respond with the appropriate action.

More instructions to follow soon...

## Thanks

Thanks to [https://gitlab.com/mailcare/mailcare](https://gitlab.com/mailcare/mailcare) and [https://github.com/niftylettuce/forward-email](https://github.com/niftylettuce/forward-email) for their awesome open-source projects that helped me along the way.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.