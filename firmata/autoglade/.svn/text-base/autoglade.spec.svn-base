#
# rpm spec for autoglade
# Copyright (C) 2007 Diego Torres Milano <diego@codtech.com>
#
# $Id$

%define name    autoglade
%define ver     0.3
%define rel     1
%define filelst %{name}-%{ver}-files
%define pkg 	 CODTECH Packages <packages@codtech.com>
%define debug_package %{nil}

Summary: Autoglade
Vendor: Diego Torres Milano
Name: %{name}
Version: %{ver}
Release: %{rel}
BuildArch: noarch
License: GPL
Group: User Interface/Desktops
Packager: %{pkg}
URL: http://autoglade.sourceforge.net
Source: %{name}-%{ver}.tar.gz
BuildRoot: %{_tmppath}/%{name}-%{ver}-root
Requires: gnome-terminal, python >= 2.4, pygtk2 >= 2.6, gnome-python2 >= 2.10, gnome-python2-gconf >= 2.10, GConf2 >= 2.10

%description
GNOME Terminal Launcher uses the profiles stores in GCONF to create
a menu with the corresponding launchers.
GNOME Termina Launcher is a panel applet.


%prep
%setup -n %{name}-%{version}


%build


%install
[ "%{buildroot}" != '/' ] && rm -rf %{buildroot}
make DESTDIR=%{buildroot} install

%__os_install_post
find %{buildroot} -type f -print|sed -e "s@^%{buildroot}@@g; s@\([^\\]\) @\1\\\ @g" > %{filelst}

%files -f %{filelst}
%defattr(-,root,root)

%clean
[ "%{buildroot}" != '/' ] && rm -rf %{buildroot}

%post
true

%changelog
* Wed Oct 10 2007 %{pkg}
  - autoglade-0.3-1
    First public package
