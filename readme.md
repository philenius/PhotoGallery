# README

## Deployment
* Edit the php configuration file `/etc/php/7.0/Apache/php.ini`. The following three options restrict the upload size of files. Make sure that these options are set to a minimum of 30MB or higher:
    * `upload_max_filesize`
    * `post_max_size`
    * `memory_limit`

* Make sure that Apache has read and write permissions to the `public/uploads` folder which contains the uploaded images.
* Make sure that the web server has read and write permissions to the zip archive `allPhotos.zip` within the directory `public/uploads/`.
* Make sure `ImageMagick` is installed:
```
sudo apt-get install imagemagick
```
* Don't forget to run the migrations with the seeder:
```
php artisan migrate --seed
```