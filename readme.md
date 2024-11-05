# WP docker lemp for custom theme

1. Run `docker-compose -p your-project-name up -d`
2. Change data DB_PASSWORD and DB_USER in wp-config.php (pass - wordpress, user - wordpress)
3. Install wordpress
4. Go to Apperance and select Custom-theme
5. Go to Page and create New page, select Template->Home
6. Go to Setting->Reading. Select Your homepage displays = A static page and then select Homepage = Main

## For style and JS

1. Run `npm install`
2. For drvelopment run `npm i` and `npm run watch`
2. For production run `npm run build`