// lib/core/utils/helpers.dart
// ─────────────────────────────────────────────────────────────────────────────
// Pure, stateless helper functions shared across the application.
// ─────────────────────────────────────────────────────────────────────────────

import 'dart:convert';
import 'package:crypto/crypto.dart';
import 'package:intl/intl.dart';

abstract final class AppHelpers {
  // ── Password hashing (SHA-256) ───────────────────────────────────────────────
  /// Returns a hex-encoded SHA-256 hash of [plainText].
  /// Use for password storage only – never store raw passwords.
  static String hashPassword(String plainText) {
    final bytes = utf8.encode(plainText);
    final digest = sha256.convert(bytes);
    return digest.toString();
  }

  // ── Date/time formatting ─────────────────────────────────────────────────────
  /// Formats an ISO-8601 string or DateTime to a human-readable date.
  static String formatDate(String? isoDate, {String pattern = 'MMM d, yyyy'}) {
    if (isoDate == null || isoDate.isEmpty) return '—';
    try {
      final dt = DateTime.parse(isoDate);
      return DateFormat(pattern).format(dt);
    } catch (_) {
      return isoDate;
    }
  }

  /// Returns an ISO-8601 string from [dateTime].
  static String toIsoString(DateTime dateTime) => dateTime.toIso8601String();

  /// Returns the current UTC timestamp as an ISO-8601 string.
  static String nowIso() => DateTime.now().toUtc().toIso8601String();

  // ── String utilities ─────────────────────────────────────────────────────────
  /// Capitalises the first letter of each word.
  static String toTitleCase(String value) => value
      .split(' ')
      .map(
        (w) => w.isEmpty
            ? w
            : '${w[0].toUpperCase()}${w.substring(1).toLowerCase()}',
      )
      .join(' ');

  /// Returns initials from a full name (e.g. "Mark Gacutno" → "MG").
  static String initials(String fullName) {
    final parts = fullName.trim().split(RegExp(r'\s+'));
    if (parts.isEmpty) return '';
    if (parts.length == 1) return parts[0][0].toUpperCase();
    return '${parts.first[0]}${parts.last[0]}'.toUpperCase();
  }

  // ── Validation ────────────────────────────────────────────────────────────────
  /// Returns `true` if [email] matches a basic e-mail pattern.
  static bool isValidEmail(String email) =>
      RegExp(r'^[^@\s]+@[^@\s]+\.[^@\s]+$').hasMatch(email.trim());

  /// Returns `true` if [url] starts with http or https.
  static bool isValidUrl(String url) =>
      Uri.tryParse(url)?.hasAbsolutePath ?? false;
}
