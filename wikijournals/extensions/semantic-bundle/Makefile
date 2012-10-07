ver = `date +%Y%m%d`

all:
	rm -rf release
	mkdir release
	awk '{ system("svn export "$$2" release/"$$1) }' < externals
	sed -i -r -e "s/'version'\s*=>\s*'(.*)'/'version' => '\1$(ver)'/" release/semantic-bundle/SemanticBundle.php
	tar -C release -c ./ | gzip >SemanticBundle-${ver}.tgz
	7z a SemanticBundle-${ver}.7z release
	(cd release; zip -r ../SemanticBundle-${ver}.zip .)
	rm -rf release
dev:
	rm -rf dev 
	mkdir dev
	awk '{ system("svn export "$$2" dev/"$$1) }' < externals.dev
	sed -i -r -e "s/'version'\s*=>\s*'(.*)'/'version' => '\1$(ver)-dev'/" dev/semantic-bundle/SemanticBundle.php
	tar -C dev -c ./ | gzip >SemanticBundle-dev-$(ver).tgz
	7z a SemanticBundle-dev-${ver}.7z dev
	(cd dev; zip -r ../SemanticBundle-dev-$(ver).zip .)
	rm -rf dev
clean:
	rm -rf release dev SemanticBundle-*.tgz SemanticBundle-dev-*.tgz SemanticBundle-*.zip SemanticBundle-dev-*.zip SemanticBundle-*.7z SemanticBundle-dev-*.7z
ext:
	(cd ..; svn propset svn:externals -F semantic-bundle/externals .)
	(cd ..; svn update)
ext-dev:
	(cd ..; svn propset svn:externals -F semantic-bundle/externals.dev .)
	(cd ..; svn update)
