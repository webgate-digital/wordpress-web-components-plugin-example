PLUGIN_DOMAIN_NAME=example-plugin

build:
	# Install and build web components
	(cd web-components && npm install --no-progress && npm run build)

	# Prepare dist and temporary directory
	mkdir -p dist/ && mkdir -p .tmp_plugin/web-components

	# Copy plugin files into temporary directory
	rsync -aq $(PLUGIN_DOMAIN_NAME)/* .tmp_plugin

	# Copy web component files into plugin directory
	cp -r web-components/www/build/* .tmp_plugin/web-components

	# Build plugin ZIP
	(cd .tmp_plugin && zip -ro "../dist/$(PLUGIN_DOMAIN_NAME).zip" *)

	# Clean up
	rm -rf .tmp_plugin