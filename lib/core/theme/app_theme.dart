// lib/core/theme/app_theme.dart
// ─────────────────────────────────────────────────────────────────────────────
// Material 3 theme definitions for PortFolioPH.
// All colour values sourced from AppConstants – no magic literals here.
// ─────────────────────────────────────────────────────────────────────────────

import 'package:flutter/material.dart';
import 'package:portfolioph/core/constants/app_constants.dart';

abstract final class AppTheme {
  // ── Light theme ──────────────────────────────────────────────────────────────
  static ThemeData get light => ThemeData(
    useMaterial3: true,
    colorScheme: ColorScheme.fromSeed(
      seedColor: AppConstants.primaryColor,
      brightness: Brightness.light,
      primary: AppConstants.primaryColor,
      secondary: AppConstants.accentColor,
      error: AppConstants.errorColor,
      surface: AppConstants.surfaceColor,
    ),
    scaffoldBackgroundColor: AppConstants.surfaceColor,
    appBarTheme: const AppBarTheme(
      backgroundColor: AppConstants.primaryColor,
      foregroundColor: AppConstants.onPrimaryColor,
      elevation: AppConstants.elevationLow,
      centerTitle: true,
      titleTextStyle: TextStyle(
        fontSize: AppConstants.fontSizeXl,
        fontWeight: FontWeight.w600,
        color: AppConstants.onPrimaryColor,
      ),
    ),
    bottomNavigationBarTheme: const BottomNavigationBarThemeData(
      selectedItemColor: AppConstants.primaryColor,
      unselectedItemColor: Colors.grey,
      showUnselectedLabels: true,
      type: BottomNavigationBarType.fixed,
      elevation: AppConstants.elevationMid,
    ),
    elevatedButtonTheme: ElevatedButtonThemeData(
      style: ElevatedButton.styleFrom(
        backgroundColor: AppConstants.primaryColor,
        foregroundColor: AppConstants.onPrimaryColor,
        padding: const EdgeInsets.symmetric(
          horizontal: AppConstants.spacingLg,
          vertical: AppConstants.spacingMd,
        ),
        shape: RoundedRectangleBorder(
          borderRadius: BorderRadius.circular(AppConstants.radiusMd),
        ),
      ),
    ),
    textButtonTheme: TextButtonThemeData(
      style: TextButton.styleFrom(foregroundColor: AppConstants.primaryColor),
    ),
    inputDecorationTheme: InputDecorationTheme(
      filled: true,
      fillColor: Colors.white,
      border: OutlineInputBorder(
        borderRadius: BorderRadius.circular(AppConstants.radiusMd),
      ),
      focusedBorder: OutlineInputBorder(
        borderRadius: BorderRadius.circular(AppConstants.radiusMd),
        borderSide: const BorderSide(
          color: AppConstants.primaryColor,
          width: 2.0,
        ),
      ),
      contentPadding: const EdgeInsets.symmetric(
        horizontal: AppConstants.spacingMd,
        vertical: AppConstants.spacingMd,
      ),
    ),
    cardTheme: CardThemeData(
      elevation: AppConstants.elevationLow,
      shape: RoundedRectangleBorder(
        borderRadius: BorderRadius.circular(AppConstants.radiusLg),
      ),
      margin: const EdgeInsets.all(AppConstants.spacingSm),
    ),
    textTheme: _buildTextTheme(Brightness.light),
    dividerTheme: const DividerThemeData(
      thickness: 1.0,
      space: AppConstants.spacingMd,
    ),
  );

  // ── Dark theme ───────────────────────────────────────────────────────────────
  static ThemeData get dark => ThemeData(
    useMaterial3: true,
    colorScheme: ColorScheme.fromSeed(
      seedColor: AppConstants.primaryColor,
      brightness: Brightness.dark,
      primary: const Color(0xFF90CAF9), // lighter blue for dark mode
      secondary: AppConstants.accentColor,
      error: AppConstants.errorColor,
      surface: const Color(0xFF121212),
    ),
    scaffoldBackgroundColor: const Color(0xFF121212),
    appBarTheme: const AppBarTheme(
      backgroundColor: Color(0xFF1A237E),
      foregroundColor: Colors.white,
      elevation: AppConstants.elevationLow,
      centerTitle: true,
      titleTextStyle: TextStyle(
        fontSize: AppConstants.fontSizeXl,
        fontWeight: FontWeight.w600,
        color: Colors.white,
      ),
    ),
    bottomNavigationBarTheme: const BottomNavigationBarThemeData(
      backgroundColor: Color(0xFF1E1E1E),
      selectedItemColor: Color(0xFF90CAF9),
      unselectedItemColor: Colors.grey,
      showUnselectedLabels: true,
      type: BottomNavigationBarType.fixed,
    ),
    elevatedButtonTheme: ElevatedButtonThemeData(
      style: ElevatedButton.styleFrom(
        backgroundColor: const Color(0xFF90CAF9),
        foregroundColor: Colors.black,
        padding: const EdgeInsets.symmetric(
          horizontal: AppConstants.spacingLg,
          vertical: AppConstants.spacingMd,
        ),
        shape: RoundedRectangleBorder(
          borderRadius: BorderRadius.circular(AppConstants.radiusMd),
        ),
      ),
    ),
    inputDecorationTheme: InputDecorationTheme(
      filled: true,
      fillColor: const Color(0xFF2C2C2C),
      border: OutlineInputBorder(
        borderRadius: BorderRadius.circular(AppConstants.radiusMd),
      ),
      focusedBorder: OutlineInputBorder(
        borderRadius: BorderRadius.circular(AppConstants.radiusMd),
        borderSide: const BorderSide(color: Color(0xFF90CAF9), width: 2.0),
      ),
      contentPadding: const EdgeInsets.symmetric(
        horizontal: AppConstants.spacingMd,
        vertical: AppConstants.spacingMd,
      ),
    ),
    cardTheme: CardThemeData(
      color: const Color(0xFF1E1E1E),
      elevation: AppConstants.elevationLow,
      shape: RoundedRectangleBorder(
        borderRadius: BorderRadius.circular(AppConstants.radiusLg),
      ),
      margin: const EdgeInsets.all(AppConstants.spacingSm),
    ),
    textTheme: _buildTextTheme(Brightness.dark),
  );

  // ── Shared text theme builder ─────────────────────────────────────────────────
  static TextTheme _buildTextTheme(Brightness brightness) {
    final Color baseColor = brightness == Brightness.light
        ? Colors.black87
        : Colors.white;

    return TextTheme(
      displayLarge: TextStyle(
        fontSize: AppConstants.fontSizeDisplay,
        fontWeight: FontWeight.w700,
        color: baseColor,
      ),
      titleLarge: TextStyle(
        fontSize: AppConstants.fontSizeXxl,
        fontWeight: FontWeight.w600,
        color: baseColor,
      ),
      titleMedium: TextStyle(
        fontSize: AppConstants.fontSizeXl,
        fontWeight: FontWeight.w500,
        color: baseColor,
      ),
      bodyLarge: TextStyle(fontSize: AppConstants.fontSizeLg, color: baseColor),
      bodyMedium: TextStyle(
        fontSize: AppConstants.fontSizeMd,
        color: baseColor,
      ),
      bodySmall: TextStyle(
        fontSize: AppConstants.fontSizeSm,
        color: baseColor.withValues(alpha: 0.7),
      ),
      labelLarge: TextStyle(
        fontSize: AppConstants.fontSizeLg,
        fontWeight: FontWeight.w600,
        color: baseColor,
      ),
    );
  }
}
