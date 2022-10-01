from django.urls import path

from .views import HomePageView, AboutPageView, ScannerView

urlpatterns = [
    path("", HomePageView.as_view(), name="home"),
    path("about/", AboutPageView.as_view(), name="about"),
    path("scanner/", ScannerView.as_view(), name="scanner")
]
