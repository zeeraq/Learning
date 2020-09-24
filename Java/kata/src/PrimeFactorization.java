/**
 * Given a positive number n > 1 find the prime factor decomposition of n. The result will be a string with the following form :
 *
 *  "(p1**n1)(p2**n2)...(pk**nk)"
 * where a ** b means a to the power of b
 *
 * with the p(i) in increasing order and n(i) empty if n(i) is 1.
 *
 * Example: n = 86240 should return "(2**5)(5)(7**2)(11)"
 */

public class PrimeFactorization {

    public static void main(String[] args) {
        System.out.println(factors(933555431));
    }

    public static String factors(int n) {
        String result = PrimeFactorization.compute(n, (int) n/2 + 1);
        if (result.isEmpty())
            result = "(" + n + ")";
        return result;
    }

    public static String compute(int n, int k_max) {
        String str = "";
        for (int i = 2; i < k_max; i++) {
            int pow = 0;
            if (n == 1)
                return str;
            while (n % i == 0) {
                pow++;
                n /= i;
            }
            if (pow > 1) {
                str += "(" + i + "**" + pow + ")";
            } else if (pow == 1) {
                str +="(" + i + ")";
            }
        }
        return str;
    }
}
