all:
	true

install:
	./setup.py install --root=$(DESTDIR)

clean:
	echo rm -rf $(CURRDIR)/debian/autoglade
	rm -rf build
	rm -rf build-stamp
	rm -rf debian/autoglade

deb:
	dpkg-buildpackage -rfakeroot

rpm:
	echo rpm
