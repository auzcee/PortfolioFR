// lib/core/constants/app_constants.dart
// ─────────────────────────────────────────────────────────────────────────────
// Central repository for every literal value used across the app.
// RULE: Zero magic numbers/strings outside this file.
// ─────────────────────────────────────────────────────────────────────────────

import 'package:flutter/material.dart';

abstract final class AppConstants {
  // ── App metadata ────────────────────────────────────────────────────────────
  static const String appName = 'PortFolioPH';
  static const String appVersion = '1.0.0';
  static const String appTagline = 'Build your portfolio, own your future.';

  // ── Database ────────────────────────────────────────────────────────────────
  static const String dbName = 'portfolioph.db';
  static const int dbVersion = 1;

  // ── SharedPreferences keys ──────────────────────────────────────────────────
  static const String prefUserId = 'userId';
  static const String prefThemeMode = 'themeMode';
  static const String prefOnboardingDone = 'onboardingDone';

  // ── Brand colours (raw ARGB – used by AppTheme) ─────────────────────────────
  static const Color primaryColor = Color(0xFF0D47A1); // Deep Blue
  static const Color accentColor = Color(0xFFFF9800); // Orange
  static const Color errorColor = Color(0xFFD32F2F);
  static const Color successColor = Color(0xFF388E3C);
  static const Color warningColor = Color(0xFFF57C00);
  static const Color surfaceColor = Color(0xFFF5F5F5);
  static const Color onPrimaryColor = Color(0xFFFFFFFF);

  // ── Typography scale (sp) ────────────────────────────────────────────────────
  static const double fontSizeXs = 10.0;
  static const double fontSizeSm = 12.0;
  static const double fontSizeMd = 14.0;
  static const double fontSizeLg = 16.0;
  static const double fontSizeXl = 20.0;
  static const double fontSizeXxl = 24.0;
  static const double fontSizeDisplay = 32.0;

  // ── Spacing / padding (dp) ───────────────────────────────────────────────────
  static const double spacingXs = 4.0;
  static const double spacingSm = 8.0;
  static const double spacingMd = 16.0;
  static const double spacingLg = 24.0;
  static const double spacingXl = 32.0;
  static const double spacingXxl = 48.0;

  // ── Border radii ─────────────────────────────────────────────────────────────
  static const double radiusSm = 4.0;
  static const double radiusMd = 8.0;
  static const double radiusLg = 16.0;
  static const double radiusFull = 999.0;

  // ── Elevation ────────────────────────────────────────────────────────────────
  static const double elevationLow = 2.0;
  static const double elevationMid = 4.0;
  static const double elevationHigh = 8.0;

  // ── Animation durations ──────────────────────────────────────────────────────
  static const Duration durationFast = Duration(milliseconds: 150);
  static const Duration durationNormal = Duration(milliseconds: 300);
  static const Duration durationSlow = Duration(milliseconds: 600);
  static const Duration splashDuration = Duration(seconds: 3);

  // ── Bottom navigation ────────────────────────────────────────────────────────
  static const int navIndexHome = 0;
  static const int navIndexPortfolio = 1;
  static const int navIndexResume = 2;
  static const int navIndexSkills = 3;
  static const int navIndexProfile = 4;

  // ── Image/asset paths ────────────────────────────────────────────────────────
  static const String logoPath = 'assets/images/logo.png';
  static const String placeholderAvatarPath =
      'assets/images/avatar_placeholder.png';

  // ── Validation limits ────────────────────────────────────────────────────────
  static const int maxUsernameLength = 50;
  static const int minPasswordLength = 8;
  static const int maxBioLength = 500;
  static const int maxProjectDescriptionLength = 1000;
}
