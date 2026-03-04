// lib/presentation/providers/navigation_provider.dart
// ─────────────────────────────────────────────────────────────────────────────
// Tracks the selected bottom-navigation tab index.
// ─────────────────────────────────────────────────────────────────────────────

import 'package:flutter/foundation.dart';
import 'package:portfolioph/core/constants/app_constants.dart';

class NavigationProvider extends ChangeNotifier {
  int _currentIndex = AppConstants.navIndexHome;

  int get currentIndex => _currentIndex;

  void goTo(int index) {
    if (_currentIndex == index) return; // avoid redundant rebuilds
    _currentIndex = index;
    notifyListeners();
  }

  void goHome() => goTo(AppConstants.navIndexHome);
  void goPortfolio() => goTo(AppConstants.navIndexPortfolio);
  void goResume() => goTo(AppConstants.navIndexResume);
  void goSkills() => goTo(AppConstants.navIndexSkills);
  void goProfile() => goTo(AppConstants.navIndexProfile);
}
